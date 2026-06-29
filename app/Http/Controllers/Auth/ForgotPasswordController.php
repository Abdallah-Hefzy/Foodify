<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\traits\ApiTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ForgotPasswordController extends Controller
{

    use ApiTrait;

    public function sendOTP(Request $request)
    {

        $request->validate([
            'phone' => ['required', 'string', 'regex:/^01[0125][0-9]{8}$/'],
        ]);

        $user = User::where('phone', $request->phone)->first();


        if (! $user) {
            return $this->error([], 'Wrong phone number', 404);
        }
        $otp_code = random_int(1000, 9999);
        $user->otp_code = $otp_code;
        $user->otp_expires_at = Carbon::now('Africa/Cairo')->addMinutes(5);
        $user->save();

        return $this->data(['dev_otp' => $otp_code],'OTP code sent successfully to your phone number');
    }


    public function verifyOTP(Request $request)
    {

        $request->validate([
            'phone' => ['required', 'string', 'regex:/^01[0125][0-9]{8}$/'],
            'otp_code' => ['required', 'digits:4'],
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return $this->error([], 'User not found', 404);
        }

        if ($request->otp_code != $user->otp_code) {
            return $this->error([], 'Invalid OTP code ', 400);
        }

        if (Carbon::now('Africa/Cairo')->greaterThan($user->otp_expires_at)) {
            return $this->error([], 'OTP code has expired', 400);
        }

        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        $token = $user->createToken('foodify_auth_token', ['password-reset'])->plainTextToken;

        return $this->data(['token' => $token]);
    }


    public function resetPassword(Request $request)
    {

        $request->validate([
            'password' => ['required', 'string', 'confirmed', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()],
        ]);

        $user = auth()->user();
        if (!$user->tokenCan('password-reset')) {
            return $this->error([], 'Unauthorized token action', 403);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        $user->currentAccessToken()->delete();

        return $this->success('Password has been reset successfully.');
    }
}
