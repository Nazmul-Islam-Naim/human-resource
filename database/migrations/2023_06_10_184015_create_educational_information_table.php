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
        Schema::create('educational_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('general_information_id')->constrained('general_information')->onDelete('cascade');
            $table->foreignId('degree_id')->constrained('degrees')->onDelete('cascade');
            $table->foreignId('passing_year_id')->constrained('passing_years')->onDelete('cascade');
            $table->foreignId('reading_subject_id')->constrained('reading_subjects')->onDelete('cascade');
            $table->foreignId('board_id')->constrained('boards')->onDelete('cascade');
            $table->string('result',15);
            $table->string('document')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_information');
    }
};
