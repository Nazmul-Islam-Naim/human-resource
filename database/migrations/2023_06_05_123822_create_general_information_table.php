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
            $table->string('psc_merit_serial',50)->nullable();
            $table->string('name_in_bangla',100);
            $table->string('name_in_english',100)->nullable();
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->date('birth_date')->nullable();
            $table->string('posting')->nullable();
            $table->string('location')->nullable();
            $table->tinyInteger('sex')->default(1)->comment('1= male, 2= female, 3= others');
            $table->tinyInteger('maritial_status')->default(1)->comment('1=single, 2= married, 3= divorce/separated, 4=widowed');
            $table->string('nid',20)->nullable();
            $table->string('fathers_name_in_bangla',100);
            $table->string('fathers_name_in_english',100)->nullable();
            $table->string('mothers_name_in_bangla',100);
            $table->string('mothers_name_in_english',100)->nullable();
            $table->date('joining_date')->nullable()->comment('order/joining date');
            $table->date('go_date')->nullable()->comment('confirmation g.o. date');
            $table->tinyInteger('religion')->default(1)->comment('1=muslim, 2=christian, 3=hindu, 4=buddha, 5=others');
            $table->tinyInteger('freedom_fighter')->default(1)->comment('1= no, 2= yes');
            $table->tinyInteger('freedom_fighter_child')->default(1)->comment('child or grand child, 1= no, 2= yes');
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
