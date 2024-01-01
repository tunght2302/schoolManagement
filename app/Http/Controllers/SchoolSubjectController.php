<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolSubject\SchoolSubjectRequest;
use App\Models\SchoolSubject;
use App\Models\SchoolSubjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SchoolSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        private SchoolSubject $schoolSubjectmodel,
        private SchoolSubjectType $schoolSubjectTypemodel
    ) {
    }
    public function index()
    {
        $getAllSchoolSubject = $this->schoolSubjectmodel->latest()->paginate(10);
        $getAllSchoolSubjectTye = $this->schoolSubjectTypemodel->select('id', 'name')->get();
        return view('admin.schoolSubjectManagement.index', [
            'getAllSchoolSubject' => $getAllSchoolSubject,
            'getAllSchoolSubjectTye' => $getAllSchoolSubjectTye
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getAllSchoolSubjectTye = $this->schoolSubjectTypemodel::select('id', 'name')->get();
        return view('admin.schoolSubjectManagement.create', ['getAllSchoolSubjectTye' => $getAllSchoolSubjectTye]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolSubjectRequest $request)
    {
        try {
            $oneSchoolSubject = $this->schoolSubjectmodel::create($request->validated());
            $oneSchoolSubject->save();

            return redirect(route('admin.schoolSubjectManagement.index'))->with('success', 'Thêm thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm môn học' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm môn học. Vui lòng thử lại');
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
        $getAllSchoolSubjectTye = $this->schoolSubjectTypemodel::select('id', 'name')->get();
        $oneSchoolSubject = $this->schoolSubjectmodel::findOrFail($id);
        return view('admin.schoolSubjectManagement.edit', [
            'getAllSchoolSubjectTye' => $getAllSchoolSubjectTye,
            'oneSchoolSubject' => $oneSchoolSubject
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SchoolSubjectRequest $request, string $id)
    {
        try {
            $oneSchoolSubject = $this->schoolSubjectmodel::findOrFail($id);
            $oneSchoolSubject->update($request->validated());

            return redirect(route('admin.schoolSubjectManagement.index'))->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật môn học' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật môn học. Vui lòng thử lại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleteSchoolSubject = $this->schoolSubjectmodel::findOrFail($id);
            $deleteSchoolSubject->delete();

            return redirect(route('admin.schoolSubjectManagement.index'))->with('success', 'Xoá thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xoá môn học' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xoá môn học. Vui lòng thử lại');
        }
    }

    public function searchSchoolSubject(SchoolSubjectRequest $request)
    {
        // Lấy thông tin từ form search
        $searchName = $request->get('searchName');
        $searchSubjectType = $request->get('searchSubjectType');

        // Lọc theo tên môn học nếu có
        $schoolSubjects = SchoolSubject::query();
        if ($searchName) {
            $schoolSubjects->where('name', 'like', '%' . $searchName . '%');
        }

        // Lọc theo loại môn học nếu có
        if ($searchSubjectType && $searchSubjectType != 0) {
            $schoolSubjects->where('school_subject_type_id',$searchSubjectType);
        }

        // Lấy kết quả đã lọc
        $getAllSchoolSubject = $schoolSubjects->paginate(10);
        $getAllSchoolSubjectTye = $this->schoolSubjectTypemodel->select('id', 'name')->get();
        return view('admin.schoolSubjectManagement.index', [
            'getAllSchoolSubject' => $getAllSchoolSubject,
            'getAllSchoolSubjectTye' => $getAllSchoolSubjectTye
        ]);
    }
}