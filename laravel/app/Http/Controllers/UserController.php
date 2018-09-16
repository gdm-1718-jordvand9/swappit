<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withTrashed()
            ->latest()
            ->paginate();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = User::ROLES;

        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->password     = Hash::make($request->password);
        $user->role         = $request->role;
        $user->verify_token = str_random(40);
        $user->save();

        $user->sendVerificationMail($user);

        return redirect('users')
            ->with(['message' => $user->name , 'datatype' => 'User', 'crudtype' => 'created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $ticketCount = $user->TicketCount();
        $orderCount = $user->OrderCount();

        return view('user.show', compact('user', 'ticketCount', 'orderCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = User::ROLES;
        $user = User::withTrashed()->findOrFail($id);

        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->name     = request('name');
        $user->email    = request('email');
        $user->password = request('password');
        $user->role     = request('role');
        $user->update();

        return redirect('users')->with(['message' => $user->name, 'datatype' => 'User', 'crudtype' => 'updated']);
    }

    /**
     * Force Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect('users')->with(['message' => $user->name, 'datatype' => 'User', 'crudtype' => 'forcedeleted']);
    }

    /**
     * Softdelete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->delete();

        return redirect('users')->with(['message' => $user->name, 'datatype' => 'User', 'crudtype' => 'deleted']);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect('users')->with(['message' => $user->name, 'datatype' => 'User', 'crudtype' => 'restored']);
    }
}
