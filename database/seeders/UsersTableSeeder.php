<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users= [
            [
                'name' => 'Ashain',
                'email' => 'ashain760@gmail.com',
                'password' => md5('Aa1#bcde'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'John Bass',
                'email' => 'johnbass456@digitalmart.com',
                'password' => md5('Xy2$wxyz'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Niko Hamlet',
                'email' => 'nikohamlet456@digitalmart.com',
                'password' => md5('Lk3@mnop'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insert multiple users into the 'users' table
        User::insert($users);
    }
}
