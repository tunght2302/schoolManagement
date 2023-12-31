<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthLoginRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            return redirect()->back()->with('error', 'Vui lòng nhập đúng email và mật khẩu ');
        }
    }

    public function AuthLogout()
    {
        Auth::logout();
        return redirect(route('admin.auth.login'))->with('success', 'Đăng xuất thành công');
    }

    public function ForgotPassword()
    {
        return view('auth.forgot_password');
    }

    public function ResetPassword($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if (!empty($user)) {
            $data['user'] = $user;
            return view('auth.reset_password', $data);
        } else {
            abort(404);
        }
    }

    public function ResetPasswordConfirm($token, Request $request)
    {
        if ($request->password == $request->cpassword) {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect(route('admin.auth.login'))->with('success', 'Đặt lại mật khẩu thành công');
        } else {
            return redirect()->back()->with('error', 'Mật khẩu không trùng khớp');
        }
    }

    public function ForgotPasswordConfirm(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if (!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', 'Vui lòng kiểm tra email và đặt lại mật khẩu của bạn');
        } else {
            return redirect()->back()->with('error', 'Email không tồn tại');
        }
    }
}