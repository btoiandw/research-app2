<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        $user = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'role' => '1'
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => bcrypt('123456'),
                'role' => '0'
            ],
            [
                'name' => 'director',
                'email' => 'director@gmail.com',
                'password' => bcrypt('123456'),
                'role' => '2'
            ]
        ];
        foreach($user as $key => $value){
            User::create($value);
        }
    }
}
