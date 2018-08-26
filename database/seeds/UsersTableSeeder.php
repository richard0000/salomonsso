<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name'      => 'admin',
            'surname'   => 'admin',
            'email'     => 'admin@salomon.com',
            'password'  => app('hash')->make('s@l0m0n'),
            'church_id' => '1',
        ]);

        factory(User::class, (int) env('FAKER_CANT_USERS'))->create();
    }
}
