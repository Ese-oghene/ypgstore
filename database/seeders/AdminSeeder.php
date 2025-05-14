<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $user = User::create([
            'email' => 'ypgstore@gmail.com',
            'name' => 'ypgstore',
            'password' => Hash::make('44444111'),
            'phone_no' => '',
            'role' => 'admin',
        ]);

        $user->assignRole('admin');
    }
}
