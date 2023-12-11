<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'John Doe',
            'email' => 'admin' . '@gmail.com',
            'password' => Hash::make('12345678'),
            'is_SuperAdmin' => 1,
            'status' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
