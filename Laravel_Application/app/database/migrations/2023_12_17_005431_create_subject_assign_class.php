<?php

use App\Models\Classe;
use App\Models\Subject;
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
        Schema::create('subject_assign_class', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status');
            $table->tinyInteger('is_deleted');
            $table->tinyInteger('createdBy');
            $table->foreignIdFor(Subject::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Classe::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_assign_class');
    }
};
