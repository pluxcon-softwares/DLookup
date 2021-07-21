<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\LotteryResult;

class ImportLotteryResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:lottery_results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import past national lottery results';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Set the path for the CSV files
        $path = base_path('/resources/import/ssn/*.csv');

        //run 2 loops at a time
        $g = glob($path);

        foreach(array_slice($g, 0, 1) as $file)
        {
            //read data into array
            $data = array_map('str_getcsv', file($file));

            //loop over the data
            foreach($data as $row)
            {
                //insert the record or update if the data already exists
                LotteryResult::updateOrCreate(['week' => $row[0]],[
                    'week' => $row[0],
                    'week_date' => $row[1],
                    'w1' => $row[2],
                    'w2' => $row[3],
                    'w3' => $row[4],
                    'w4' => $row[5],
                    'w5' => $row[6],
                    'm1' => $row[7],
                    'm2' => $row[8],
                    'm3' => $row[9],
                    'm4' => $row[10],
                    'm5' => $row[11]
                ]);
            }

            unlink($file);
        }
        return 0;
    }
}
