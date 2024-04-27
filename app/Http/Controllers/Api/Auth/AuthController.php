<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\CreateUserRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(CreateUserRequest $request)
    {
        $user=User::create($request->validated());

        return new UserResource($user);
    }

    public function login(LoginUserRequest $request)
    {
        $user = User::where('email', $request->validated('email'))->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $user->tokens()->delete();
        $access_token=$user->createToken($request->validated('email'))->plainTextToken;
        $user=new UserResource($user);

        return compact('access_token','user');
    }

    public function user()
    {
        return new UserResource(auth()->user());
    }

    public function tokens()
    {
        $tokens = auth()->user()->tokens;
       
        return $tokens;
    }

    public function generateToken()
    {
        auth()->user()->tokens()->delete();

        $access_token=auth()->user()->createToken(auth()->user()->email)->plainTextToken;;

        return $access_token;
    }

    public function logout()
    {
        auth()->logout();

        return response('',204);
    }
}