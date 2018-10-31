<?php

use Illuminate\Database\Seeder;
use App\StickyNote;

class StickyNotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StickyNote::create([
            'title'=>'Test 1',
            'content'=>'Hello, World',
            'order'=>1,
            'user_id'=>1
        ]);
        StickyNote::create([
            'title'=>'Test 2',
            'content'=>'test 2 content',
            'order'=>2,
            'user_id'=>1
        ]);
        StickyNote::create([
            'title'=>'Test 3',
            'content'=>'Shei The Great',
            'order'=>3,
            'user_id'=>1
        ]);
        StickyNote::create([
            'title'=>'Test 4',
            'content'=>'Hello World',
            'order'=>4,
            'user_id'=>1
        ]);
        StickyNote::create([
            'title'=>'Test 5',
            'content'=>'Shei The Great',
            'order'=>5,
            'user_id'=>1
        ]);
        StickyNote::create([
            'title'=>'Test 6',
            'content'=>'Hello World',
            'order'=>6,
            'user_id'=>1
        ]);
    }
}
