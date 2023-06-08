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
        Schema::create('general_information', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id',50)->nullable();
            $table->string('name_in_bangla',100);
            $table->string('name_in_english',100)->nullable();
            $table->string('fathers_name_in_bangla',100);
            $table->string('mothers_name_in_bangla',100);
            $table->foreignId('district_id')->comment('employee district id')->constrained('districts')->onDelete('cascade');
            $table->date('birth_date')->nullable();
            $table->date('prl_date')->nullable();
            $table->foreignId('present_designation_id')->constrained('designations')->onDelete('cascade');
            $table->foreignId('present_workstation_id')->constrained('workstations')->onDelete('cascade');
            $table->foreignId('salary_scale_id')->comment('present salary scale id')->constrained('salary_scales')->onDelete('cascade');
            $table->date('joining_date')->nullable();
            $table->foreignId('joining_designation_id')->nullable()->constrained('designations')->onDelete('cascade');
            $table->date('permanent_date')->nullable()->comment('job permanent date');
            $table->string('order_no')->nullable()->comment('job permanent order number');
            $table->text('permanent_address')->nullable();
            $table->text('present_address')->nullable();
            $table->string('mobile',15)->nullable();
            $table->string('email',30)->nullable();
            $table->tinyInteger('sex')->default(1)->comment('1= male, 2= female, 3= others');
            $table->tinyInteger('maritial_status')->default(1)->comment('1=single, 2= married, 3= divorce/separated, 4=widowed');
            $table->string('spouse_name_in_bangla',100)->nullable()->comment('spouse name husband or wife');
            $table->foreignId('occupation_id')->nullable()->comment('spouse occupation')->constrained('occupations')->onDelete('cascade');
            $table->foreignId('spouse_district_id')->nullable()->constrained('districts')->onDelete('cascade');
            $table->string('photo')->nullable()->comment('passport size');
            $table->string('signature')->nullable();
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_information');
    }
};
