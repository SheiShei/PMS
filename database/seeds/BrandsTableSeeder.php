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
        $user = User::all()->pluck('id');
        $brand = Brand::create([
            'name'=>'Luljetta',
            'contact_person'=>'MJ',
            'about'=>'Spa',
            'telephone'=>'754-3010',
            'mobile'=>'09123456789',
            'logo'=>'luljetta_logo.png',
            'acma_id'=>$user[0]
        ]);

        User::find($user[4])->update([
            'brand_id'=>$brand->id
        ]);
    }
}
