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
        Schema::create('weekly_report', function (Blueprint $table) {
            $table->id();
            $table->integer('report_id');
            $table->date('report_date');
            $table->string('week',255);
            $table->string('month',255);
            $table->string('year',255);
            $table->text('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_report');
    }
};
