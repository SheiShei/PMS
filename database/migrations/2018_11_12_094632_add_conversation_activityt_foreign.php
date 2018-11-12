<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConversationActivitytForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conversation_activities', function (Blueprint $table) {
            $table->index('conversation_id');
            $table->index('main');
            $table->index('support');

            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            $table->foreign('main')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('support')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversation_activities', function (Blueprint $table) {
            $table->dropColumn('conversation_id');
            $table->dropColumn('main');
            $table->dropColumn('support');

            $table->dropForeign('conversation_activities_conversation_id_foreign');
            $table->dropForeign('conversation_activities_main_foreign');
            $table->dropForeign('conversation_activities_support_foreign');

            $table->dropIndex('conversation_activities_conversation_id_index');
            $table->dropIndex('conversation_activities_main_index');
            $table->dropIndex('conversation_activities_support_index');
        });
    }
}
