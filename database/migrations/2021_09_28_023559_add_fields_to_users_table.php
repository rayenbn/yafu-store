<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_name', 190)->nullable();
            $table->string('phone', 190)->nullable();
            $table->string('position', 190)->nullable();
            $table->string('country', 190)->nullable();
            $table->string('countryCode', 10)->nullable();
            $table->string('address', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('company_name');
            $table->dropColumn('phone');
            $table->dropColumn('position');
            $table->dropColumn('country');
            $table->dropColumn('address');
        });
    }
}
