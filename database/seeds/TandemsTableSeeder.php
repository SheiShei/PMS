<?php

use Illuminate\Database\Seeder;
use App\Tandem;
use App\User;

class TandemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all()->pluck('id');
        Tandem::create([
            'name'=>'jen-sam',
            'acma_id'=>$user[1],
            'ga_id'=>$user[2]
        ]);
    }
}
