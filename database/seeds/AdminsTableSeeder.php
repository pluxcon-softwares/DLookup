<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name'  =>  'system',
            'email' => 'prolabdomains@gmail.com',
            'password'  => '@@FOrcehackhts22@@'
        ]);

        $admin = Admin::create([
            'name'  =>  'Admin',
            'email' => 'admin@localhost.test',
            'password'  => '123456'
        ]);
    }
}
