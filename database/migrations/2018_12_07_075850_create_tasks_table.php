<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->unsignedInteger('card_id')->index();
            $table->char('jo_id', 36)->index()->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->char('created_by', 36)->index();
            $table->char('assigned_to', 36)->index();
            $table->char('assigned_by', 36)->index();
            $table->tinyInteger('order');
            $table->tinyInteger('points')->default('1');
            $table->date('due')->nullable();
            $table->string('task_cover')->nullable();
            $table->timestamps();

            $table->foreign('jo_id')->references('id')->on('job_orders')->onDelete('cascade');
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
