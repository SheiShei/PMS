<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->text('text')->nullable();
            $table->string('original_filename')->nullable();
            $table->string('new_filename')->nullable();
            $table->string('extension')->nullable();
            $table->dateTime('seen')->nullable();
            $table->dateTime('read')->nullable();
            $table->char('conversation_id', 36)->index()->nullable();
            $table->char('sender_id', 36)->index();
            $table->char('receiver_id', 36)->index()->nullable();
            $table->tinyInteger('action')->default('1');
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
        Schema::dropIfExists('messages');
    }
}
