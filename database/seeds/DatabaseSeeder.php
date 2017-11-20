<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(TimesheetSeeder::class);
        
        factory(App\Timesheets::class, 50)->create();
    }
}
