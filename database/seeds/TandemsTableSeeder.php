<?php

use Illuminate\Database\Seeder;
use App\Tandem;

class TandemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tandem::create([
            'name'=>'jen-sam',
            'acma_id'=>2,
            'ga_id'=>3
        ]);
    }
}
