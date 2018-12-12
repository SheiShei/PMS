<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoCreativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jo_creatives', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('jo_id')->index();
            $table->string('media')->nullable();
            $table->string('ad_type')->nullable();
            $table->string('file_type')->nullable();
            $table->text('copy')->nullable();
            $table->text('post_caption')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->text('revisions')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->unsignedInteger('signed_by')->index()->nullable();
            $table->timestamps();

            $table->foreign('signed_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('jo_creatives');
    }
}
