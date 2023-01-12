<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'user_type' => 1,
            'phone' => '1111111111',
            'address' => 'N/A',
            'password' => Hash::make('admin'),
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@user.com',
            'user_type' => 0,
            'phone' => '0000000000',
            'address' => 'N/A',
            'password' => Hash::make('user'),
        ]);
    }
}
