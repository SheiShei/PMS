<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jo_webs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('jo_id')->index();
            $table->string('request_type')->nullable();
            $table->tinyInteger('tech')->nullable();
            $table->tinyInteger('domain_transfer')->nullable();
            $table->tinyInteger('domain_renewal')->nullable();
            $table->text('action_points')->nullable();
            $table->string('target_list')->nullable();
            $table->datetime('web_proofed_at')->nullable();
            $table->unsignedInteger('web_proofed_by')->index()->nullable();
            $table->datetime('acma_proofed_at')->nullable();
            $table->unsignedInteger('acma_proofed_by')->index()->nullable();
            $table->timestamps();

            $table->foreign('web_proofed_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('acma_proofed_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('jo_id')->references('id')->on('job_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jo_webs');
    }
}
