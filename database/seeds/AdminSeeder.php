<?php

use Illuminate\Database\Seeder;

use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User:::create([
        	'name' => 'admin',
            'email' => 'admin',
            'password' => bcrypt('admin'),
            'fundcc' => ' ',
            'jobcode' => ' ',
            'admin' => '1';
        ]);
    }
}
