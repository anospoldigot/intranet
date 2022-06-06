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
        $user = User::create([
            'name' => 'Muhammad Ramadhan',
            'email' => 'ramaramarama009@gmail.com',
            'password' => bcrypt('password')
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'name' => 'rama',
            'email' => 'amawdh@gmail.com',
            'password' => bcrypt('password')
        ]);

        // $user->assignRole('admin');

        // $user = User::create([
        //     'name' => 'Muhammad Ramadhan',
        //     'email' => 'ramaramarama009@gmail.com',
        //     'password' => bcrypt('password')
        // ]);

        $user->assignRole('sales');
    }
}
