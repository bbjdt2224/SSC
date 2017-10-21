<?php

use Illuminate\Database\Seeder;
use App\Timesheets;

class TimesheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Timesheets::create([
        	'user' => '-1',
        	'startdate'=> '2017-01-01',
        	'firstweek' => '-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0',
        	'secondweek' => '-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0|-,-,-,-,-,-,-,0',
        	'totals' => '0,0,0',
        	'submitted' => '0',
        ]);
    }
}
