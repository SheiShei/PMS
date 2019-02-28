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
            'name'=>'Sassy Lacsamana',
            'email'=>'sassy@captivate.com',
            'password'=>bcrypt('adminpass'),
            'role_id'=>1,
            'department_id'=>1,
            'picture'=>'sassy.jpg',
            'bg_image' => 'bg-default.jpeg'
        ]);

        User::create([
            'name'=>'Test Account',
            'email'=>'test@test.com',
            'password'=>bcrypt('testpass'),
            'role_id'=>1,
            'department_id'=>1,
            'picture'=>'sassy.jpg',
            'bg_image' => 'bg-default.jpeg'
        ]);
    }
}
