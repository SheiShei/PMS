<?php

use Illuminate\Database\Seeder;
use App\Board;
use App\Sprint;
use App\Card;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Board::create([
            'name' => 'Test Creative Board',
            'type' => '1',
            'created_by' => 1
        ]);

        Board::create([
            'name' => 'Test Web Board',
            'type' => '2',
            'created_by' => 1
        ]);

        Sprint::create([
            'name' => 'Test Web version 1',
            'board_id' => 2,
            'created_by' => 1
        ]);

        Sprint::create([
            'name' => 'Test Web version 2',
            'board_id' => 2,
            'created_by' => 1
        ]);

        Card::create([
            'name' => 'New',
            'board_id' => 1,
            'created_by' => 1
        ]);

        Card::create([
            'name' => 'Completed',
            'board_id' => 1,
            'created_by' => 1
        ]);

        Card::create([
            'name' => 'New',
            'sprint_id' => 1,
            'created_by' => 1
        ]);

        Card::create([
            'name' => 'Completed',
            'sprint_id' => 1,
            'created_by' => 1
        ]);

        Card::create([
            'name' => 'New',
            'sprint_id' => 2,
            'created_by' => 1
        ]);

        Card::create([
            'name' => 'Completed',
            'sprint_id' => 2,
            'created_by' => 1
        ]);
    }
}
