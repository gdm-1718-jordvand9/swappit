<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create();
        $user = new User();
        $user->name             = 'Test';
        $user->email            = 'test@swappit.com';
        $user->remember_token   = str_random(10);
        $user->password         = Hash::make('wickedman');
        $user->role             = 'superadmin';
        $user->save();
    }
}
