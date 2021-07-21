<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\Models\Ticket;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::create([
            'title' =>  'Title for ticket one',
            'body'  =>  'kjasdjaosdjafsidjaosjdiojafsojdajosdjaosodaaspdjapso',
            'user_id'   =>  1,
            'is_replied'    =>  0
        ]);

        Ticket::create([
            'title' =>  'Title for ticket two',
            'body'  =>  'kjasdjaosdjafsidjaosjdiojafsojdajosdjaosodaaspdjapso',
            'user_id'   =>  1,
            'is_replied'    =>  0
        ]);

        Ticket::create([
            'title' =>  'Title for ticket two',
            'body'  =>  'kjasdjaosdjafsidjaosjdiojafsojdajosdjaosodaaspdjapso',
            'user_id'   =>  1,
            'is_replied'    =>  0
        ]);

        Ticket::create([
            'title' =>  'Title for ticket two',
            'body'  =>  'kjasdjaosdjafsidjaosjdiojafsojdajosdjaosodaaspdjapso',
            'user_id'   =>  2,
            'is_replied'    =>  0
        ]);

        Ticket::create([
            'title' =>  'Title for ticket two',
            'body'  =>  'kjasdjaosdjafsidjaosjdiojafsojdajosdjaosodaaspdjapso',
            'user_id'   =>  2,
            'is_replied'    =>  0
        ]);

        Ticket::create([
            'title' =>  'Title for ticket two',
            'body'  =>  'kjasdjaosdjafsidjaosjdiojafsojdajosdjaosodaaspdjapso',
            'user_id'   =>  2,
            'is_replied'    =>  0
        ]);
    }
}
