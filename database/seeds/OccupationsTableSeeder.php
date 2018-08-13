<?php

use Illuminate\Database\Seeder;
use App\Occupation;

class OccupationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Occupation::truncate();
        factory(\App\Occupation::class, env('FAKER_CANT_OCCUPATIONS'))->create();
    }
}
