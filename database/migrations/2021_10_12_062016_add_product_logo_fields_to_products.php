<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductLogoFieldsToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->smallInteger('haslogo')->default(0);
            $table->integer('logoprice')->default(0);
        });
        Schema::table('carts', function (Blueprint $table) {
            $table->string('logofile', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('haslogo');
            $table->dropColumn('logoprice');
        });
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('logofile');
        });
    }
}
