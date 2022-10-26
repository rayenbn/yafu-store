<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('sec2_image1', 255)->nullable();
            $table->String('sec2_text1', 255)->nullable();
            $table->String('sec2_desc1', 255)->nullable();
            $table->String('sec2_link1', 255)->nullable();
            $table->String('sec2_image2', 255)->nullable();
            $table->String('sec2_text2', 255)->nullable();
            $table->String('sec2_desc2', 255)->nullable();
            $table->String('sec2_link2', 255)->nullable();
            $table->String('sec2_image3', 255)->nullable();
            $table->String('sec2_text3', 255)->nullable();
            $table->String('sec2_desc3', 255)->nullable();
            $table->String('sec2_link3', 255)->nullable();
            $table->String('sec3_title', 255)->nullable();
            $table->String('sec3_subtitle', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_pages');
    }
}
