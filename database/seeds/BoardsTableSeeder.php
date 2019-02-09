<?php

use Illuminate\Database\Seeder;
use App\Board;
use App\Sprint;
use App\Card;
use App\User;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all()->pluck('id');
        $board = Board::create([
            'name' => 'Test Creative Board',
            'type' => '1',
            'created_by' => $user[0]
        ]);

        Board::create([
            'name' => 'Test Web Board',
            'type' => '2',
            'created_by' => $user[0]
        ]);

        $sprint = Sprint::create([
            'name' => 'Test Web version 1',
            'board_id' => $board->id,
            'created_by' => $user[0],
            'type' => 1
        ]);

        Sprint::create([
            'name' => 'Test Web version 2',
            'board_id' => $board->id,
            'created_by' => $user[0],
            'type' => 2
        ]);

        Card::create([
            'name' => 'New',
            'board_id' => $board->id,
            'created_by' => $user[0],
            'order' => 1
        ]);

        Card::create([
            'name' => 'Completed',
            'board_id' => $board->id,
            'created_by' => $user[0],
            'order' => 2
        ]);

    }
}
