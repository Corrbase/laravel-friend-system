<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => "User 1",
            'email' => env('DEV_USER_1_EMAIL', 'user1@gmail.com'),
            'password' => bcrypt(env('DEV_USER_1_PASS', '12345678')),
        ]);

        User::create([
            'name' => "User 2",
            'email' => env('DEV_USER_2_EMAIL', 'user2@gmail.com'),
            'password' => bcrypt(env('DEV_USER_2_PASS', '12345678')),
        ]);

        User::create([
            'name' => "User 3",
            'email' => env('DEV_USER_3_EMAIL', 'user3@gmail.com'),
            'password' => bcrypt(env('DEV_USER_3_PASS', '12345678')),
        ]);
    }
}
