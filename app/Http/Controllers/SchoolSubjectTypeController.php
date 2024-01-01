<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolSubjectType\SchoolSubjectTypeRequest;
use App\Models\SchoolSubjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SchoolSubjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        private SchoolSubjectType $model
    ) {
    }
    public function index()
    {
        $getAllSchoolSubjectType = $this->model->latest()->paginate(10);
        return view('admin.schoolSubjectTypeManagement.index', ['getAllSchoolSubjectType' => $getAllSchoolSubjectType]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.schoolSubjectTypeManagement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolSubjectTypeRequest $request)
    {
        try {
            $newSchoolSubjectType = $this->model::create($request->validated());
            $newSchoolSubjectType->save();
            return redirect(route('admin.schoolSubjectTypeManagement.index'))->with('success', 'Thêm thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm loại môn học' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm loại môn học. Vui lòng thử lại');
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
        $oneSchoolSubjectType = $this->model::findOrFail($id);
        return view('admin.schoolSubjectTypeManagement.edit', ['oneSchoolSubjectType' => $oneSchoolSubjectType]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SchoolSubjectTypeRequest $request, string $id)
    {
        try {
            $oneSchoolSubjectType = $this->model::findOrFail($id);
            $oneSchoolSubjectType->update($request->validated());
            $oneSchoolSubjectType->save();
            return redirect(route('admin.schoolSubjectTypeManagement.index'))->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật loại môn học' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật loại môn học. Vui lòng thử lại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleteSchoolSubjectType = $this->model::findOrFail($id);
            $deleteSchoolSubjectType->delete();
            return redirect(route('admin.schoolSubjectTypeManagement.index'))->with('success', 'Xoá thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xoá loại môn học' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xoá loại môn học. Vui lòng thử lại');
        }
    }

    public function searchSchoolSubjectType(SchoolSubjectTypeRequest $request)
    {
        $search = $request->search;
        $getAllSchoolSubjectType = $this->model::where('name', 'LIKE', '%' . $search . '%')->paginate(10);

        return view('admin.schoolSubjectTypeManagement.index', ['getAllSchoolSubjectType' => $getAllSchoolSubjectType]);
    }
}