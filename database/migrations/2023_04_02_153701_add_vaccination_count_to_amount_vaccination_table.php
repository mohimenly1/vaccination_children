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
            $table->integer('vaccination_count')->default(0); 
            $table->unsignedBigInteger('health_id')->nullable();
            $table->foreign('health_id')->references('id')->on('users');
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
