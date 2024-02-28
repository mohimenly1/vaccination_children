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
        Schema::create('amount_vaccination_user', function (Blueprint $table) {
            $table->id();


            $table->unsignedBigInteger('amount_vaccination_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('count');
            $table->unsignedBigInteger('health_id');
            $table->foreign('amount_vaccination_id')->references('id')->on('amount_vaccination')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('health_id')->references('id')->on('users')->onDelete('cascade');



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
        Schema::dropIfExists('amount_vaccination_user');
    }
};
