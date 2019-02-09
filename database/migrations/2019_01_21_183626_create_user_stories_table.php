<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_stories', function (Blueprint $table) {
            $table->increments('id');
            $table->char('sprint_id', 36)->index()->nullable();
            $table->string('name');
            $table->text('description');
            $table->char('created_by', 36)->index();
            $table->tinyInteger('points');
            $table->tinyInteger('order');
            $table->timestamps();

            $table->foreign('sprint_id')->references('id')->on('sprints')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_stories');
    }
}
