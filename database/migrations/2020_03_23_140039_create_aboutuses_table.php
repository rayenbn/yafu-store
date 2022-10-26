<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aboutuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->String('banner', 255);
            // $table->String('banner_title');
            $table->string('sec_one_title', 190)->nullable();
            $table->longText('sec_one_text')->nullable();
            $table->string('sec_one_img')->nullable();
            // $table->string('sec_two_title')->nullable();
            // $table->string('sec_two_bg')->nullable();
            // $table->string('sec_two_t1')->nullable();
            // $table->longText('sec_two_desc1')->nullable();
            // $table->string('sec_two_t2')->nullable();
            // $table->longText('sec_two_desc2')->nullable();
            // $table->string('sec_two_t3')->nullable();
            // $table->longText('sec_two_desc3')->nullable();
            // $table->string('gallery_banner')->nullable();
            // $table->string('gallery_title')->nullable();
            // $table->string('gallery_subtitle')->nullable();
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
        Schema::dropIfExists('aboutuses');
    }
}
