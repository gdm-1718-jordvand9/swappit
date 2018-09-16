<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AccountRequest;
use App\Http\Requests\Api\RestoreRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        if ($user) {
            return response()->json($user);
        }
        return reponse()->json('Notauthenticated.', 401);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $request)
    {
        $user = Auth::user();
        $user->name     = request('name');
        $user->email    = request('email');
        $user->update();

        return response()->json('Account successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = Auth::user();
        $user->update(['restore_token' => str_random(40)]);
        $user->delete();

        return response()->json('Account deactivated successfully, check your email to reactivate again.');

    }

    public function restore($token)
    {
        $user = User::withTrashed()
            ->where('restore_token', $token)
            ->whereNotNull('deleted_at')
            ->firstOrFail();

        if(Carbon::parse($user->deleted_at)->addDays(4) < Carbon::now()){
            $user->restore();
            $user->update(['restore_token' => null]);
            return response()
                ->json('Account restored successfully.');
        } else {
            return response()
                ->json('Account has not been deleted for over 4 days yet.');
        }
    }

    public function restoreMail(RestoreRequest $request)
    {
       $user = User::withTrashed()
           ->where('email', request('email'))
           ->whereNotNull('deleted_at')
           ->firstOrFail();
       $user->sendRestoreMail();
       return response()->json('email sent');
    }

    public function delete()
    {
        $user = Auth::user();
        $user->forceDelete();

        return response()->json('User is kapot.');
    }
}
