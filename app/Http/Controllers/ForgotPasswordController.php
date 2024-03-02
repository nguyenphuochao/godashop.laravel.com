<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Customer;
class ForgotPasswordController extends Controller
{
    function sendResetLinkEmail() {
        $email = request()->input('email');
        $token = hash('sha256',Str::random(40));

        //Store token into table customer
        $customer = Customer::where("email", $email)->first();
        $customer->reset_token = $token;
        $customer->save();
        $customerName = $customer->name;
        $link_reset = route('password.reset',['token' => $token, 'email' => $email]);
        
        //send email
        $input = request()->all();
        $input['link_reset'] = $link_reset;
        $input['customerName'] = $customerName;
        Mail::send('forgotpassword.reset', $input, 
        
        function($message) use ($input) {
            $to = $input['email'];
            $message->to($to, $input["customerName"])->subject("Reset Password Notification")->replyTo($input["email"])->from(env('MAIL_SHOP'));
        });
        if (Mail::failures()) {
            //error
            session()->put('error', 'Lỗi gởi email reset password');
        }
        else {
            //success
            session()->put('success', 'Vui lòng check email để reset password');
        }
        return redirect()->route('index');
    }

    function sendEmail(Request $request) {
        $input = $request->all();
        Mail::send('contact.sendmail', $input, 
        
        function($message) use ($input) {
            $to = env('MAIL_SHOP');
            $message->to($to, 'Godashop')->subject("Godashop: customer contact {$input['fullname']}")->replyTo($input["email"])->from($input["email"]);
        });
        if (Mail::failures()) {
            //error
            echo 'Không thể gởi mail. Vui lòng liên hệ với admin';
        }
        else {
            //success
            echo 'Đã gởi mail thành công';
        }
    }
    
}
