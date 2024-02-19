<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'headmaster',
            'email' => 'headmaster@gmail.com',
            'password' => Hash::make('headmaster'),
            'role' => 'headmaster'
        ]);
        DB::table('users')->insert([
            'name' => 'student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('student'),
            'role' => 'student'
        ]);
        DB::table('users')->insert([
            'name' => 'adam',
            'email' => 'adam@gmail.com',
            'password' => Hash::make('adam'),
            'role' => 'student'
        ]);

        DB::table('payments')->insert([
            'fee' => 1500000,
            'title' => 'Tuition Fee',
            'description' => 'Tuition fee for first year student',
            'deadline' => '2023-12-04'
        ]);
        DB::table('payments')->insert([
            'fee' => 2700000,
            'title' => 'Building Fee',
            'description' => 'Building fee for first year student',
            'deadline' => '2023-11-01'
        ]);

        DB::table('payment_headers')->insert([
            'user_id' => '2',
            'payment_id' => '1',
            'created_at' => Date::now()
        ]);
        DB::table('payment_headers')->insert([
            'user_id' => '2',
            'payment_id' => '2',
            'created_at' => Date::now()
        ]);
        DB::table('payment_headers')->insert([
            'user_id' => '3',
            'payment_id' => '1',
            'created_at' => Date::now()
        ]);
        DB::table('payment_headers')->insert([
            'user_id' => '3',
            'payment_id' => '2',
            'created_at' => Date::now()
        ]);
    }
}
