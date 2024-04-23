<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(CreateUserRequest $request)
    {
        return User::create($request->validated());
    }

    public function login(LoginUserRequest $request)
    {
        $user = User::where('email', $request->validated('email'))->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        $access_token=$user->createToken($request->validated('email'))->plainTextToken;
        $user=new UserResource($user);

        return compact('access_token','user');
    }

    public function user()
    {
        return new UserResource(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response('',204);
    }
}