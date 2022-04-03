<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'  =>  'user1',
            'email'     => 'user1@app.com',
            'password'  => 123456789,
            'wallet'    => 0,
            'active'    =>  1
        ]);

        User::create([
            'username'  =>  'user2',
            'email'     => 'user2@app.com',
            'password'  => 123456,
            'wallet'    => 0,
            'active'    => 1
        ]);
    }
}
