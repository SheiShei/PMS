<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkbookFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workbook_files', function (Blueprint $table) {
            $table->increments('id');
            $table->char('workbook_id', 36)->index();
            $table->boolean('isApproved')->default(false);
            $table->timestamps();

            $table->foreign('workbook_id')->references('id')->on('workbooks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workbook_files');
    }
}
