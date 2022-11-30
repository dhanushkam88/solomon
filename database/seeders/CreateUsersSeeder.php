<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Dhanushka Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('Dhanushka@1234')
        ])->assignRole('admin');

        $user = User::create([
            'name' => 'Dhanushka Vendor',
            'email' => 'vendor@test.com',
            'password' => Hash::make('Dhanushka@1234')
        ])->assignRole('vendor');

        $user = User::create([
            'name' => 'Dhanushka User',
            'email' => 'user@test.com',
            'password' => Hash::make('Dhanushka@1234')
        ])->assignRole('user');
    }
}
