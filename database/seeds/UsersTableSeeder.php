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
            'email'     => 'user1@localhost.test',
            'password'  => 123456,
            'wallet'    => 1000
        ]);

        User::create([
            'username'  =>  'user2',
            'email'     => 'user2@localhost.test',
            'password'  => 123456,
            'wallet'    => 1000
        ]);

        User::create([
            'username'  =>  'user3',
            'email'     => 'user3@localhost.test',
            'password'  => 123456,
            'active'    => 0
        ]);

        User::create([
            'username'  =>  'user4',
            'email'     => 'user4@localhost.test',
            'password'  => 123456,
            'active'    => 1
        ]);

        User::create([
            'username'  =>  'user5',
            'email'     => 'user5@localhost.test',
            'password'  => 123456,
            'active'    => 1,
            'wallet'    =>  0
        ]);

        User::create([
            'username'  =>  'user6',
            'email'     => 'user6@localhost.test',
            'password'  => 123456,
            'active'    => 1,
            'wallet'    =>  6
        ]);
    }
}
