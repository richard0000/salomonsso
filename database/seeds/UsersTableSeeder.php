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
            'email'     => env('FAKE_ADMIN_USER'),
            'password'  => app('hash')->make(env('FAKE_ADMIN_PASSWORD')),
            'church_id' => '1',
        ]);

        factory(User::class, (int) env('FAKER_CANT_USERS'))->create();
    }
}
