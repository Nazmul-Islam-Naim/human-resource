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
        Schema::create('permanent_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('general_information_id')->constrained('general_information')->onDelete('cascade');
            $table->string('village')->nullable()->comment('village/house no & road');
            $table->string('post_office')->nullable();
            $table->string('police_station')->nullable();
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->string('telephone',15)->nullable()->comment('telephone number');
            $table->string('moblie',15)->nullable()->comment('moblie number');
            $table->string('eamil',50)->nullable()->comment('email address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permanent_addresses');
    }
};
