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
        Schema::create('monthly_report', function (Blueprint $table) {
            $table->id();
            $table->text('report_name');
            $table->date('report_date');
            $table->integer('level_id');
            $table->integer('periode_id');
            
            $table->string('month');
            $table->string('year');
            $table->text('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_report');
    }
};
