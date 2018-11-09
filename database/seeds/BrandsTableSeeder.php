<?php

use Illuminate\Database\Seeder;
use App\Brand;
use App\User;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'name'=>'Luljetta',
            'contact_person'=>'MJ',
            'about'=>'Spa',
            'telephone'=>'754-3010',
            'mobile'=>'+639123456789',
            'logo'=>'luljetta_logo.png',
            'tandem_id'=>1
        ]);

        User::find(5)->update([
            'brand_id'=>1
        ]);
    }
}
