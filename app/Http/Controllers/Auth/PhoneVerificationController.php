<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\traits\ApiTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PhoneVerificationController extends Controller
{

    use ApiTrait;

    public function sendVerificationOTP()
    {
        $user = auth()->user();
        $otp_code = random_int(1000, 9999);
        $user->otp_code = $otp_code;
        $user->otp_expires_at = Carbon::now('Africa/Cairo')->addMinutes(5);
        $user->save();

        return $this->data(['dev_otp' => $otp_code],'OTP Code Sent Successfully!');
    }


    public function verifyPhone(Request $request)
    {


        $request->validate([
            'otp_code' => ['required', 'digits:4'],
        ]);

        $user = auth()->user();


        if ($request->otp_code != $user->otp_code) {
            return $this->error([], 'Invalid OTP code ', 400);
        }

       if (Carbon::now('Africa/Cairo')->greaterThan($user->otp_expires_at)) {
            return $this->error([], 'OTP code has expired', 400);

        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->phone_verified_at = now();
        $user->save();
        return $this->success('you are verified now!');
    }
}
