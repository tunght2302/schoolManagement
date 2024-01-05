<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {
        $getUser = Auth::user();
        return view('admin.profile.index', compact('getUser'));
    }

    public function edit()
    {
        $getUser = Auth::user();
        return view('admin.profile.edit', compact('getUser'));
    }

    public function update(ProfileRequest $request)
    {
        try {
            $updateProfile = User::findOrFail(Auth::user()->id);
            $updateProfile->update($request->validated());

            return redirect(route('admin.profile.index'))->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật hồ sơ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật hồ sơ.Vui lòng kiếm tra lại');
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $user = User::findOrFail(Auth::user()->id);
            if (Hash::check($request->input('oldPassword'), $user->password)) {
                if ($request->input('newPassword') === $request->confirmPassword) {
                    $user->password = Hash::make($request->newPassword);
                    $user->save();

                    return redirect(route('admin.dashboard'))->with('success', 'Đổi mật khẩu thành công');
                } else {
                    return redirect()->back()->with('error', 'Mật khẩu mới và mật khẩu xác nhận không khớp.');
                }
            }
            return redirect()->back()->with('error', 'Mật khẩu cũ không khớp');
        } catch (\Exception $e) {
            Log::error('Lỗi khi đổi mật khẩu' . $e->getMessage());

            return redirect()->back()->with('error', 'Có lỗi xảy ra khi đổi mật khẩu.Vui lòng thử lại');
        }
    }
}