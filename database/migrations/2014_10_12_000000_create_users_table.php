<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            // $tabel->string('employee_id',15)->unique();
            $table->string('name');
            $table->string('slug');
            $table->string('email',50)->unique();
            $table->string('password');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedInteger('brand_id')->nullable();
            // $table->unsignedInteger('tandem_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
