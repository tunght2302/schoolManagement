<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(
        private User $Usermodel,
        private Role $Rolemodel,
        // private UserRequest $request
    ) {
    }
    public function index()
    {
        $getAllUser = $this->Usermodel->latest()->paginate(10);
        return view("admin.adminManagement.index", ['getAllUser' => $getAllUser]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getRole = Role::all();
        return view('admin.adminManagement.create', ['getRole' => $getRole]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $newUser = $this->Usermodel::create($request->validated());
            $newUser->password = Hash::make($request->password);
            $newUser->role_id = $request->role_id;
            $newUser->save();

            return redirect(route('admin.adminManagement.index'))->with('success', 'Thêm thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm người dùng: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm người dùng. Vui lòng thử lại');
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
    public function edit($id)
    {
        $oneUser = $this->Usermodel::find($id);
        $getRole = $this->Rolemodel::all();
        return view('admin.adminManagement.edit', ['oneUser' => $oneUser, 'getRole' => $getRole]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {
            $user = $this->Usermodel::findOrFail($id);
            $user->update($request->validated());
            $user->password = Hash::make($request->password);
            $user->role_id = $request->role_id;
            $user->save();

            return redirect(route('admin.adminManagement.index'))->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật người dùng: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật người dùng. Vui lòng thử lại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = $this->Usermodel::findOrFail($id);
            $user->delete();
            return redirect(route('admin.adminManagement.index'))->with('success', 'Xoá thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xoá người dùng: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xoá người dùng. Vui lòng thử lại');
        }
    }

    public function searchAdmin(UserRequest $request)
    {
        $search = $request->search ? $request->search : '';
        $getAllUser = User::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->paginate(10)
            ->withQueryString();
        return view('admin.adminManagement.index', ['getAllUser' => $getAllUser]);
    }
}