<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index('role_id');
            $table->index('brand_id');
            // $table->index('tandem_id');
            
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            // $table->foreign('tandem_id')->references('id')->on('tandems')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_id_foreign');
            $table->dropIndex('users_role_id_index');
            $table->dropColumn('role_id');

            $table->dropForeign('users_brand_id_foreign');
            $table->dropIndex('users_brand_id_index');
            $table->dropColumn('brand_id');

            // $table->dropForeign('users_tandem_id_foreign');
            // $table->dropIndex('users_tandem_id_index');
            // $table->dropColumn('tandem_id');
        });
    }
}
