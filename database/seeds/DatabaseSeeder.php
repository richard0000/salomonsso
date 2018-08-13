<?php

use Illuminate\Database\Seeder;
use App\Church;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checking because truncate() may fail
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        $this->call('OccupationsTableSeeder');
        $this->call('ChurchesTableSeeder');
        $this->call('UsersTableSeeder');

        // Enable it back
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
