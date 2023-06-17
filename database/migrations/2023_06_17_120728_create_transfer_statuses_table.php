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
        Schema::create('transfer_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('general_information_id')->constrained('general_information')->onDelete('cascade');
            $table->date('present_joining_date')->comment('present workstation joining date')->nullable();
            $table->foreignId('workstation_id')->nullable()->comment('previous workstation')->constrained('workstations')->onDelete('cascade');
            $table->foreignId('designation_id')->nullable()->comment('previous designation')->constrained('designations')->onDelete('cascade');
            $table->date('previous_joining_date')->nullable()->comment('previous workstation joining date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_statuses');
    }
};
