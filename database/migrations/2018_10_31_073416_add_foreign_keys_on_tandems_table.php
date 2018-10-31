<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysOnTandemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tandems', function (Blueprint $table) {
            $table->index('acma_id');
            $table->index('ga_id');

            $table->foreign('acma_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ga_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tandems', function (Blueprint $table) {
            $table->dropForeign('tandems_acma_id_foreign');
            $table->dropIndex('tandems_acma_id_index');
            $table->dropColumn('acma_id');

            $table->dropForeign('tandems_ga_id_foreign');
            $table->dropIndex('tandems_ga_id_index');
            $table->dropColumn('ga_id');
        });
    }
}
