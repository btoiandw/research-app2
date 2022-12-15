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
                'role' => '1',
                'organization_id'=>'48'
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => bcrypt('123456'),
                'role' => '0',
                'organization_id'=>'30'
            ],
            [
                'name' => 'director',
                'email' => 'director@gmail.com',
                'password' => bcrypt('123456'),
                'role' => '2',
                'organization_id'=>0
            ],
            [
                'name' => 'พัชราวรรณ เกิดพันธ์',
                'email' => 'biw@gmail.com',
                'password' => bcrypt('123456'),
                'role' => '0',
                'organization_id'=>'30'
            ],
            [
                'name' => 'พรทิพย์ แซ่ฟุ้ง',
                'email' => 'pim@gmail.com',
                'password' => bcrypt('123456'),
                'role' => '0',
                'organization_id'=>'30'
            ],
            [
                'name' => 'วิรุฬศักดิ์ ชัยรินทร์',
                'email' => 'tar@gmail.com',
                'password' => bcrypt('123456'),
                'role' => '0',
                'organization_id'=>'30'
            ],
            [
                'name' => 'ผศ.ดร.ฆัมภิชา ตันติสันติสม',
                'email' => 'khumphicha@gmail.com',
                'password' => bcrypt('123456'),
                'role' => '2',
                'organization_id'=>30
            ],
            [
                'name' => 'ผศ.พรหมเมศ วีระพันธ์',
                'email' => 'Phrommet@gmail.com',
                'password' => bcrypt('123456'),
                'role' => '2',
                'organization_id'=>30
            ],
            [
                'name' => 'ผศ.บุณยกฤต รัตนพันธุ์',
                'email' => 'boonyakrit.kpru@gmail.com',
                'password' => bcrypt('123456'),
                'role' => '2',
                'organization_id'=>35
            ],
            [
                'name' => 'ผศ.ดร.ชญาดา กลิ่นจันทร์',
                'email' => 'chayada.aor@gmail.com',
                'password' => bcrypt('123456'),
                'role' => '2',
                'organization_id'=>36
            ]
        ];
        foreach($user as $key => $value){
            User::create($value);
        }
    }
}
