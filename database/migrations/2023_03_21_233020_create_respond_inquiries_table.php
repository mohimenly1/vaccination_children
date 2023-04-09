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
        Schema::create('respond_inquiries', function (Blueprint $table) {
            $table->id();
            $table->text('FeedBackText');
            $table->enum('FeedBackType', ['type1', 'type2', 'type3']);
            $table->enum('FeedBackState', ['pending', 'resolved'])->default('pending');
            $table->text('FeedBackReply')->nullable();
            
            $table->bigInteger('users_app_id')->unsigned();
            $table->bigInteger('users_health_center_id')->unsigned();
            
            $table->foreign('users_app_id')->references('id')->on('users');
            $table->foreign('users_health_center_id')->references('id')->on('users');
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
        Schema::dropIfExists('respond_inquiries');
    }
};
