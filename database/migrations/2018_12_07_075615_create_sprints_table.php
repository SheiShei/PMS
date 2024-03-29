<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSprintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sprints', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->char('board_id', 36)->index();
            $table->string('name');
            $table->text('goals')->nullable();
            $table->char('created_by', 36)->index();
            $table->tinyInteger('type');
            $table->date('started_at')->nullable();
            $table->date('finished_at')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sprints');
    }
}
