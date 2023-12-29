<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private function getRedirectPath($roleId)
    {
        $roleRedirects = [
            1 => 'admin/dashboard',
            2 => 'teacher/dashboard',
            3 => 'student/dashboard',
            4 => 'parent/dashboard',
        ];

        return $roleRedirects[$roleId] ?? '';
    }

    public function login()
    {
        if (Auth::check()) {
            $redirectPath = $this->getRedirectPath(Auth::user()->role_id);
            return redirect($redirectPath);
        }

        return view('auth.login');
    }

    public function AuthLogin(Request $request)
    {
        $remember = $request->has('remember');

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $redirectPath = $this->getRedirectPath(Auth::user()->role_id);
            return redirect($redirectPath)->with('success', 'Đăng nhập thành công');
        } else {
            return redirect()->back()->with('error', 'Vui lòng nhập email và mật khẩu hiện tại');
        }
    }

    public function AuthLogout()
    {
        Auth::logout();
        return redirect(url(''))->with('success', 'Đăng xuất thành công');
    }
}