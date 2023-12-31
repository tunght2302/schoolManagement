<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolClass\SchoolClassRequest;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        private SchoolClass $model
    ) {
    }
    public function index()
    {
        $getAllSchoolClass = $this->model->latest()->paginate(10);
        return view('admin.schoolClassManagement.index', ['getAllSchoolClass' => $getAllSchoolClass]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.schoolClassManagement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolClassRequest $request)
    {
        try {
            $newSchoolClass = $this->model::create($request->validated());
            $newSchoolClass->created_by = Auth::user()->id;
            $newSchoolClass->save();
            return redirect(route('admin.schoolClassManagement.index'))->with('success', 'Thêm thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm lớp học:' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm lớp học. Vui lòng thử lại');
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
        $oneShoolClass = $this->model::find($id);
        return view('admin.schoolClassManagement.edit', ['oneSchoolClass' => $oneShoolClass]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SchoolClassRequest $request, string $id)
    {
        try {
            $updateShoolClass = $this->model::findOrFail($id);
            $updateShoolClass->update($request->validated());
            $updateShoolClass->save();

            return redirect(route('admin.schoolClassManagement.index'))->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật lớp học' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật người dùng.Vui lòng thử lại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleteShoolClass = $this->model::findOrFail($id);
            $deleteShoolClass->delete();

            return redirect()->back()->with('success', 'Xoá thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xoá người dùng' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xoá người dùng.Vui lòng thử lại');
        }
    }

    public function searchSchoolClass(Request $request)
    {
        $search = $request->search;
        $getAllSchoolClass = $this->model::where('name', 'LIKE', '%' . $search . '%')->paginate(10);

        return view('admin.schoolClassManagement.index', ['getAllSchoolClass' => $getAllSchoolClass]);
    }
}