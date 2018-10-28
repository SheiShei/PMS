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
            'password'=>bcrypt('sheipass')
        ]);

        User::create([
            'name'=>'test',
            'email'=>'test@test.com',
            'password'=>bcrypt('testpass')
        ]);
    }
}
