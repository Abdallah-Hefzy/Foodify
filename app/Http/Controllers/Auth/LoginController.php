<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    use ApiTrait;

    public function login(LoginRequest $request)
    {

        $user = User::where('phone', $request->phone)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {

            return $this->error([], 'username or password is wrong', 401);
        }
        $token = $user->createToken('foodify_auth_token')->plainTextToken;
        return $this->data([
            'user' => $user,
            'token' => $token,
        ], 'You have successfully logged in');
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success('You have successfully logged out');
    }
}
