<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
class ResetPasswordController extends Controller
{
    function showResetForm() {
        $email = request()->input('email');
        $token = request()->route('token');
        return view('resetpassword.reset', ['token' => $token,'email' => $email]);
    }
    
    function reset() {
        //valid reset_token
        $email = request()->input('email');
        $reset_token = request()->input('reset_token');
        $customer = Customer::where("email", $email)->first();
        if (empty($customer)) {
            //không tồn tại email
            session()->put('error','Invalid email');
            return redirect()->route('index');
        }
        if ($customer->reset_token == $reset_token) {
            //chính chủ (valid) => update new password
            $password = request()->input('password');
            $customer->password = Hash::make($password);
            $customer->reset_token = null;
            $customer->save();
            session()->put('success','Your password reset');
            return redirect()->route('index');
        }
        session()->put('error','Invalid token');
        return redirect()->route('index');
        
    }
}
