<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    function index() {
        $data = [];
        return view('admin.login.index', $data);
    }
    function login(Request $request) {
        
        $credentials = $request->only(['username', 'password']);
        if (!Auth::guard('admin')->attempt($credentials)) {
            $request->session()->put('error', 'Username hoặc password không đúng, vui lòng nhập lại');
            return redirect()->route('admin.login.form');
        }
        if (Auth::guard('admin')->user()->is_active == 0) {//chưa kích hoạt tài khoản
            Auth::guard('admin')->logout();
            $request->session()->put('error', 'Tài khoản của bạn chưa được active');
        }
        return redirect()->route('dashboard');
    }

    function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.form');
    }
}
