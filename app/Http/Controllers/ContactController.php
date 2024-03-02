<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\District;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
    function show() {
        return view('contact.show', []);
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
