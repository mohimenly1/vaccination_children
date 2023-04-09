<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amount_vaccination', function (Blueprint $table) {
            $table->bigInteger('vaccination_name')->unsigned()->change();
            $table->foreign('vaccination_name')->references('id')->on('vaccination_names')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('amount_vaccination', function (Blueprint $table) {
            //
        });
    }
};
