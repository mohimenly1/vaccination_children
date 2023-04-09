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
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('HealthCenterId')->unsigned();
            $table->foreign('HealthCenterId')->references('id')->on('users');

            $table->bigInteger('NidChild')->unsigned();
            $table->foreign('NidChild')->references('id')->on('children');


            $table->string('VaccinationName');
            $table->date('VaccinationDate');
            $table->string('NurseName');
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
        Schema::dropIfExists('vaccinations');
    }
};
