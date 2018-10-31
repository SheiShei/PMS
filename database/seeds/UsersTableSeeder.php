<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'shei',
            'email'=>'s.cmanawit@gmail.com',
            'password'=>bcrypt('sheipass'),
            'role_id'=>1,
            'department_id'=>1
        ]);

        User::create([
            'name'=>'jenjen',
            'email'=>'sinfuegojenella@gmail.com',
            'password'=>bcrypt('jenpass'),
            'role_id'=>2,
            'department_id'=>2
        ]);

        User::create([
            'name'=>'sam',
            'email'=>'sammillos@gmail.com',
            'password'=>bcrypt('sampass'),
            'role_id'=>3,
            'department_id'=>2
        ]);

        User::create([
            'name'=>'test',
            'email'=>'test@test.com',
            'password'=>bcrypt('testpass'),
            'role_id'=>1
        ]);

        User::create([
            'name'=>'Luljetta',
            'email'=>'luljetta@test.com',
            'password'=>bcrypt('luljettapass'),
            'role_id'=>4
        ]);


    }
}
