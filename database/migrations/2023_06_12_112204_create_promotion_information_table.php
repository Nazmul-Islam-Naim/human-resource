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
        Schema::create('promotion_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('general_information_id')->constrained('general_information')->onDelete('cascade');
            $table->foreignId('designation_id')->comment('promotioned designation')->constrained('designations')->onDelete('cascade');
            $table->date('promotion_date')->comment('promotion date');
            $table->string('order_no');
            $table->date('date')->comment('order and date');
            $table->foreignId('salary_scale_id')->comment('pay scale')->constrained('salary_scales')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_information');
    }
};
