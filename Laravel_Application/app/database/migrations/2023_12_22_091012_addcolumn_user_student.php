<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users',function(Blueprint $table){
            $table->string('admission_number')->nullable();
            $table->string('roll_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('admission_date')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->boolean('status')->nullable();
            $table->boolean('is_delete')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
