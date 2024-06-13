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
            $table->date('joining_date')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('permanent_adress')->nullable();
            $table->text('qualification')->nullable();
            $table->text('work_experience')->nullable();
            $table->text('note')->nullable();
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
