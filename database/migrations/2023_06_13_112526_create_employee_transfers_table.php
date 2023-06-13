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
        Schema::create('employee_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('general_information_id')->constrained('general_information')->onDelete('cascade');
            $table->foreignId('district_id')->comment('transferred district')->constrained('districts')->onDelete('cascade');
            $table->foreignId('workstation_id')->comment('transferred workstation')->constrained('workstations')->onDelete('cascade');
            $table->foreignId('designation_id')->comment('transferred designation')->constrained('designations')->onDelete('cascade');
            $table->foreignId('salary_scale_id')->comment('transferred salary scale')->constrained('salary_scales')->onDelete('cascade');
            $table->string('salary',10)->nullable();
            $table->string('house_rent',10)->nullable();
            $table->string('total_taken_leave',10)->nullable();
            $table->string('allowance',10)->nullable();
            $table->date('transferred_date');
            $table->date('joining_date');
            $table->date('release_date')->nullable();
            $table->string('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_transfers');
    }
};
