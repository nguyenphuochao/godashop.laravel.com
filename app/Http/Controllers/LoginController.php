<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login(Request $request) {
        
        $credentials = $request->only(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            $request->session()->put('error', 'Email hoặc password không đúng, vui lòng nhập lại');
            return redirect()->route('index');
        }
        if (Auth()->user()->is_active == 0) {//chưa kích hoạt tài khoản
            Auth::logout();
            $request->session()->put('error', 'Tài khoản của bạn chưa được active');
        }
        return redirect()->route('index');
    }

    function logout() {
        Auth::logout();
        return redirect()->route('index');
    }
}
