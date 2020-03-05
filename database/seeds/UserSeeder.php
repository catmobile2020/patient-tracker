<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'admin',
            'email' => 'admin',
            'password' => 123456,
            'type' => 1
        ]);

        \App\User::create([
            'name' => 'rep',
            'email' => 'rep@gmail.com',
            'password' => 123456,
            'type' => 2
        ]);
    }
}
