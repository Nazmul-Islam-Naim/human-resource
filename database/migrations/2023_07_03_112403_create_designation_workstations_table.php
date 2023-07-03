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
        Schema::create('designation_workstations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workstation_id')->constrained('workstations')->onDelete('cascade');
            $table->foreignId('designation_id')->constrained('designations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designation_workstations');
    }
};
