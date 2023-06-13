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
        Schema::create('employee_transfer_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_transfer_id')->constrained('employee_transfers')->onDelete('cascade');
            $table->string('transfer_number');
            $table->text('first_paragraph');
            $table->foreignId('present_designation_id')->comment('present workstation designantion ')->constrained('designations')->onDelete('cascade');
            $table->foreignId('present_workstation_id')->constrained('workstations')->onDelete('cascade');
            $table->foreignId('trans_designation_id')->comment('transferred workstation designantion ')->constrained('designations')->onDelete('cascade');
            $table->foreignId('trans_workstation_id')->constrained('workstations')->onDelete('cascade');
            $table->date('transferred_workstation_date');
            $table->text('editordata1');
            $table->text('editordata2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_transfer_applications');
    }
};
