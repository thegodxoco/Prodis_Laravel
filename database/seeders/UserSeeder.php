<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'name' => "Test1",
            'surname1' => "Account",
            'surname2' => "Admin",
            'email' => 'test1@test.com',
            'password' => Hash::make('12341234'),
            'phone' => '123456789',
            'admin' => true
        ]);

        DB::table('users')->insert([
            'name' => "Test2",
            'surname1' => "Account",
            'surname2' => "User",
            'email' => 'test2@test.com',
            'password' => Hash::make('12341234'),
            'phone' => '123456789'

        ]);
    }
}
