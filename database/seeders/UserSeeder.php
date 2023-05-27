<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'Admin',
            'email' => 'Admin@admin.com',
            'usertype' => '1',
            'phone' => '03109279605',
            'address' => 'Wah Cantt',
            'email_verified_at' => '2023-03-01 11:32:36',
            'password' => 'password',
            'current_team_id' => 1,
            'profile_photo_path' => '',
        ]);
    }
}
// 2023-03-01 11:32:36
