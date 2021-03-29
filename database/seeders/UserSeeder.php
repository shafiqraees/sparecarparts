<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
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
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('12345678'),
                'user_type' =>'Admin',
                'profile_photo_path' =>'profiles/5fd1bcdde6728.jpeg',
                'gender' =>'Male',
                'org_password' => '12345678',
                'device_token' => 'sdadadsdadasdasdadad',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Breaker',
                'email' => 'user1@gmail.com',
                'password' =>Hash::make('12345678'),
                'user_type' =>'Supplier',
                'profile_photo_path' =>'profiles/5fd1bcdde6728.jpeg',
                'gender' =>'Male',
                'org_password' => '12345678',
                'device_token' => 'sdadadsdadasdasdadad',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Front User',
                'email' => 'user2@gmail.com',
                'password' =>Hash::make('12345678'),
                'user_type' =>'User',
                'profile_photo_path' =>'profiles/5fd1bcdde6728.jpeg',
                'gender' =>'Male',
                'org_password' => '12345678',
                'device_token' => 'sdadadsdadasdasdadad',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        \DB::table('users')->insert($users);
    }
}
