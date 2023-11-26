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
        Schema::create('employee_pension_prls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('general_information_id')->constrained('general_information')->onDelete('cascade');
            $table->string('last_basic_salary',10);
            $table->string('leave_average_pay',10);
            $table->string('leave_half_pay',10);
            $table->string('due_provident_fund',10)->nullable();
            $table->string('leave_encashment_owed',10)->nullable();
            $table->string('amount_gratuity',10)->nullable();
            $table->string('audit_objected_amount',10)->nullable();
            $table->string('reason_audit_objections')->nullable();
            $table->string('total_amount_owed',10)->nullable();
            $table->string('amount_money_payable',10)->nullable();
            $table->string('provident_fund',10)->nullable();
            $table->string('leave_encashment',10)->nullable();
            $table->string('gratuity',10)->nullable();
            $table->string('amount_loan_taken',10)->nullable();
            $table->string('reason_amount_loan_taken')->nullable();
            $table->string('pension_document')->nullable()->comment('pension document');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_pension_prls');
    }
};
