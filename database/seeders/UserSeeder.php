<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        //
        User::create([
            'name' => 'David Tukei',
            'email' => 'david@tukei.com',
            'role' => 'admin',
            'password' => Hash::make('Password123!')
        ]);
    }
}
