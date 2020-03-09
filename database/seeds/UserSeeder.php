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
            'name' => 'rep 1',
            'email' => 'rep1@gmail.com',
            'password' => 123456,
            'type' => 2
        ]);

        \App\User::create([
            'name' => 'rep 2',
            'email' => 'rep2@gmail.com',
            'password' => 123456,
            'type' => 2
        ]);
    }
}
