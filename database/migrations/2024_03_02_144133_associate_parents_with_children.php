<?php

use App\Models\Child;
use App\Models\User;
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
               // Example logic to associate parents with their children
               $parents = User::whereNotNull('ssn')->get();
               foreach ($parents as $parent) {
                   Child::where('national_number', $parent->ssn)->update(['parent_id' => $parent->id]);
               }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
