<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_revisions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wfile_id')->index();
            $table->string('original_filename');
            $table->string('new_filename');
            $table->string('caption')->nullable();
            $table->tinyInteger('rating')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('wfile_id')->references('id')->on('workbook_files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_revisions');
    }
}
