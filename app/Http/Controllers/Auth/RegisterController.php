<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisgterRequest;
use App\Models\User;
use App\traits\ApiTrait;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use ApiTrait;

    public function register(RegisgterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('foodify_auth_token')->plainTextToken;

        return $this->data([
            'user' => $user,
            'token' => $token,
        ], 'You have been successfully registered', 201);
    }
}
