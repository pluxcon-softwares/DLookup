<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        Schema::disableForeignKeyConstraints();
        DB::table('admins')->truncate();
        DB::table('states')->truncate();
        DB::table('users')->truncate();
        DB::table('tickets')->truncate();
        DB::table('posts')->truncate();
        $this->call(AdminsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
