<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('prod_id');
            $table->string('prod_img', 255)->nullable();
            $table->string('prod_name', 255)->nullable();
            $table->longText('prod_desc')->nullable();
            $table->integer('price')->default(0);
            $table->integer('total')->default(0);
            $table->integer('qty')->default(0);
            $table->string('created_by');
            $table->smallInteger('submited')->default(0);
            $table->string('invoice_number')->nullable();
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
        Schema::dropIfExists('carts');
    }
}
