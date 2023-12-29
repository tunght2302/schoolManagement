<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    private function getRedirectPath($roleId)
    {
        $roleRedirects = [
            1 => 'admin.dashboard',
            2 => 'teacher.dashboard',
            3 => 'student.dashboard',
            4 => 'parent.dashboard',
        ];

        return $roleRedirects[$roleId] ?? '';
    }

    public function index()
    {
        if (Auth::check()) {
            $redirectPath = $this->getRedirectPath(Auth::user()->role_id);
            return view($redirectPath);
        } else {
            return redirect(url('login'))->with('error', 'Vui lòng đăng nhập để truy cập trang này');
        }
    }
}