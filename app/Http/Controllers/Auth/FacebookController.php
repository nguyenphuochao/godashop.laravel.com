<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
class FacebookController extends Controller
{
    
    function redirectToFacebook() {
        return Socialite::driver('facebook')->redirect();
    }

    function handleFacebookCallback() {
        try {
            $facebookCustomer = Socialite::driver('facebook')->user();
            $existingCustomer = Customer::where('facebook_id', $facebookCustomer->id)->orWhere('email', $facebookCustomer->email)->first();
            
            if (empty($existingCustomer)) {
                //insert into database
                $customer = new Customer();
                $customer->facebook_id = $facebookCustomer->id;
                $customer->name = $facebookCustomer->name;
                $customer->email = $facebookCustomer->email;
                $customer->is_active = 1;
                $customer->save();
                Auth::login($customer);
            }
            else {
                Auth::login($existingCustomer);
            }
            
            return redirect('/');
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
