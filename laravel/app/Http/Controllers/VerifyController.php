<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function verify($token)
    {
        User::where('verify_token', $token)->firstOrFail()
            ->update(['verify_token' => null]);

        /*return redirect()
            ->route('home')
            ->with('success', 'Account verified.');*/
        $url = 'http://localhost:4200/signin';
        return redirect($url);
    }

    public function verifyByUser($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->update(['verify_token' => null]);
        return redirect('users')->with(['message' => $user->name, 'datatype' => 'User', 'crudtype' => 'verified']);
    }

}
