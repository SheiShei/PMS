<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConversationsUserForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conversation_user', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('conversation_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversation_user', function (Blueprint $table) {
            $table->dropForeign('conversation_user_user_id_foreign');
            $table->dropIndex('conversation_user_user_id_index');
            $table->dropColumn('user_id');
            
            $table->dropForeign('conversation_user_conversation_id_foreign');
            $table->dropIndex('conversation_user_conversation_id_index');
            $table->dropColumn('conversation_id');
        });
    }
}
