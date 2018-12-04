<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('brand_id')->index();
            $table->unsignedInteger('client_id')->index();
            $table->unsignedInteger('tandem_id')->index();
            $table->dateTime('date_in');
            $table->dateTime('date_due');
            $table->tinyInteger('status')->default('1');
            $table->unsignedInteger('created_by')->index();
            $table->tinyInteger('type');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tandem_id')->references('id')->on('tandems')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_orders');
    }
}
