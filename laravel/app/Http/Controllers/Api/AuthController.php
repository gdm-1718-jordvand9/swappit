<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function signUp(RegisterRequest $request)
    {
        if(User::where('email', request('email'))->whereNotNull('restore_token')->exists()) {
            dd('exists!');
        }
        else {

            $user = User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => Hash::make(request('password')),
                'verify_token' => str_random(40),
                'role' => 'guest',
            ]);

            $user->sendVerificationMail();
        }

        return response()->json('An email has been sent.');
    }
    public function logout()
    {
        $user = Auth::user();
        $user->token()->revoke();
        $user->token()->delete();
        return response()->json(null, 204);
    }
    public function account()
    {
        $user = Auth::user();
        return response()->json($user);
    }
    public function signIn(Request $request) {
        //dd('niks');
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            if(!$user->verified()) {
                dd('user is niet verified');
            }
            else {
                $token = $user->createToken('LaraPassport')->accessToken;
                return response()->json($token, 200);
            }
        } else {
            dd('geen attempt');
        }

    }

}
