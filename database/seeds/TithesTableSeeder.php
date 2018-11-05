<?php

use Illuminate\Database\Seeder;
use App\Tithe;

class TithesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tithe::truncate();
        factory(\App\Tithe::class, (int)env('FAKER_CANT_TITHES'))->create();
    }
}
