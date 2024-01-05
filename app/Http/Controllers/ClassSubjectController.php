<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassSubject\ClassSubjectRequest;
use App\Models\ClassSubject;
use App\Models\SchoolClass;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClassSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        private ClassSubject $classSubjectModel,
        private SchoolClass $schoolClassModel,
        private SchoolSubject $schoolSubjectModel
    ) {
    }

    private function getSchoolClassAndSubject()
    {
        $getSchoolClass = $this->schoolClassModel->all();
        $getSchoolSubject = $this->schoolSubjectModel->all();

        return compact('getSchoolClass', 'getSchoolSubject');
    }
    public function index()
    {
        $schoolClasses = $this->classSubjectModel::JoinSchoolClassesAndSubjects()
            ->orderByRaw("SUBSTRING(school_classes.name, 1, 1) ASC, CAST(SUBSTRING(school_classes.name, 2) AS SIGNED) ASC")
            ->paginate(10);
        $data = $this->getSchoolClassAndSubject();
        return view('admin.classSubjectManagement.index', compact('schoolClasses', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->getSchoolClassAndSubject();

        return view('admin.classSubjectManagement.create', [
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassSubjectRequest $request)
    {
        try {
            $schoolSubjectIds = $request->school_subject_id;
            $schoolClassId = $request->school_class_id;
            $status = $request->status;

            // Giả sử bạn muốn tạo một bản ghi cho mỗi school_subject_id
            foreach ($schoolSubjectIds as $schoolSubjectId) {
                $data = [
                    'school_class_id' => $schoolClassId,
                    'school_subject_id' => $schoolSubjectId,
                    'created_by' => Auth::user()->id,
                    'status' => $status,
                ];

                $this->classSubjectModel::create($data);
            }

            return redirect(route('admin.classSubjectManagement.index'))->with('success', 'Thêm thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm phân công lớp học: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm phân công môn học. Vui lòng thử lại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->getSchoolClassAndSubject();
        $singleClassSubject = $this->classSubjectModel::findOrFail($id);

        return view('admin.classSubjectManagement.edit_single', [
            'data' => $data,
            'singleClassSubject' => $singleClassSubject
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassSubjectRequest $request, string $id)
    {
        try {
            $updateClassSubject = $this->classSubjectModel::findOrFail($id);
            $updateClassSubject->fill([
                'school_subject_id' => $request->school_subject_id,
                'school_class_id' => $request->school_class_id,
                'created_by' => Auth::user()->id,
                'status' => $request->status,
            ]);

            // Check trùng môn khi update
            $existingSubject = $this->classSubjectModel
                ->where('school_class_id', $request->school_class_id)
                ->where('school_subject_id', $request->school_subject_id)
                ->where('class_subjects.id', '<>', $id)
                ->join('school_subjects', 'class_subjects.school_subject_id', '=', 'school_subjects.id')
                ->select('school_subjects.name')
                ->first();

            if ($existingSubject) {
                return redirect()->back()
                    ->with('error', "Môn {$existingSubject->name} đã được phân công trong lớp.Vui lòng thử lại.")
                    ->withInput();
            }

            $updateClassSubject->save();

            return redirect()->route('admin.classSubjectManagement.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Log::error('Error updating class subject' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật phân công môn học. Vui lòng thử lại');
        }
    }

    public function edits(string $id)
    {
        $oneClassSubject = $this->classSubjectModel::JoinSchoolClassesAndSubjects()->first();
        $data = $this->getSchoolClassAndSubject();

        // Lấy tất cả môn học thuộc lớp
        $classSubjectsInClass = $this->classSubjectModel::where('school_class_id', $oneClassSubject->school_class_id)
            ->join('school_subjects', 'class_subjects.school_subject_id', '=', 'school_subjects.id')
            ->select('class_subjects.status', 'school_subjects.id as subjectId', 'school_subjects.name as subjectName')
            ->get();
        return view('admin.classSubjectManagement.edit_all', [
            'data' => $data,
            'oneClassSubject' => $oneClassSubject,
            'classSubjectsInClass' => $classSubjectsInClass,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updates(ClassSubjectRequest $request, string $id)
    {
        try {
            // Lấy danh sách các môn học được chọn từ request
            $selectedSubjects = $request->input('school_subject_id');

            // Lấy danh sách tất cả các bản ghi trong bảng class_subject cho lớp học này
            $classSubjects = ClassSubject::where('school_class_id', $id)->get();

            foreach ($classSubjects as $classSubject) {
                // Kiểm tra xem môn học có trong danh sách được chọn không
                $isSelected = in_array($classSubject->school_subject_id, $selectedSubjects);

                // Nếu môn học được chọn, cập nhật thông tin, ngược lại, xóa bản ghi
                if ($isSelected) {
                    $classSubject->update([
                        'created_by' => Auth::user()->id,
                        'status' => $request->status,
                    ]);
                } else {
                    $classSubject->delete();
                }
            }

            // Nếu có môn học mới được chọn, thêm chúng vào bảng class_subject
            $newSubjects = array_diff($selectedSubjects, $classSubjects->pluck('school_subject_id')->toArray());

            foreach ($newSubjects as $newSubject) {
                ClassSubject::create([
                    'school_class_id' => $id,
                    'school_subject_id' => $newSubject,
                    'created_by' => Auth::user()->id,
                    'status' => $request->status,
                ]);
            }

            return redirect(route('admin.classSubjectManagement.index'))->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Log::error('Error updating class subject' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật phân công môn học. Vui lòng thử lại');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleteClassSubject = $this->classSubjectModel::findOrFail($id);
            $deleteClassSubject->delete();
            return redirect(route('admin.classSubjectManagement.index'))->with('success', 'Xoá thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xoá phân công môn học' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xoá phân công môn học. Vui lòng thử lại');
        }
    }

    public function searchClassSubject(Request $request)
    {
        // Lấy thông tin từ form search
        $searchName = $request->get('searchName');
        $searchClass = $request->get('searchClass');

        // Lọc theo tên môn học nếu có
        $schoolClass = ClassSubject::query();

        $schoolClass = $this->classSubjectModel::JoinSchoolClassesAndSubjects();

        if ($searchName) {
            $schoolClass->where('school_subjects.name', 'like', '%' . $searchName . '%');
        }

        // Lọc theo loại môn học nếu có
        if ($searchClass && $searchClass != 0) {
            $schoolClass->where('school_class_id', $searchClass);
        }

        // Lấy kết quả đã lọc
        $schoolClasses = $schoolClass->paginate(10);
        $data = $this->getSchoolClassAndSubject();
        return view('admin.classSubjectManagement.index', [
            'schoolClasses' => $schoolClasses,
            'data' => $data
        ]);
    }
}
