<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progresses', function (Blueprint $table) {
            $table->increments('id');
            $table->char('board_id', 36)->index()->nullable();
            $table->char('sprint_id', 36)->index()->nullable();
            $table->char('jo_id', 36)->index()->nullable();
            $table->tinyInteger('remaining_points')->nullable();
            $table->tinyInteger('completed_tasks')->nullable();
            $table->tinyInteger('todo')->nullable();
            $table->tinyInteger('in_progress')->nullable();
            $table->tinyInteger('for_test')->nullable();
            $table->tinyInteger('closed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progresses');
    }
}
