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
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'is_admin' => 1
            ],
            [
                'name' => 'Operator',
                'email' => 'operator@gmail.com',
                'password' => bcrypt('operator'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
