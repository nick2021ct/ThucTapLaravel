<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
           [ 'name'=>'Quan tri',
            'email'=>'admin@gmail.com',
            'role'=>'admin',
            'status'=>'active',
            'password'=>bcrypt('password')
        ],
        [ 'name'=>'Nhan vien',
            'email'=>'employee@gmail.com',
            'role'=>'employee',
            'status'=>'active',
            'password'=>bcrypt('password')
        ],
        [ 'name'=>'Khach hang',
            'email'=>'user@gmail.com',
            'role'=>'user',
            'status'=>'active',
            'password'=>bcrypt('password')
        ],
        ]);
    }
}
