<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = "Hope Center Admin";
        $user->email = "admin@hopecenter.com";
        $user->type = "1";
        $user->password = Hash::make("password");
        $user->save();

        $user = new User();
        $user->name = "Elias Dahi";
        $user->email = "user@hopecenter.com";
        $user->type = "0";
        $user->password = Hash::make("password");
        $user->save();
    }
}
