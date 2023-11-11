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
        Schema::create('quarterly_report', function (Blueprint $table) {
            $table->id();
            $table->integer('report_id');
            $table->text('objek_monitoring')->nullable();
            $table->text('hasil_evaluasi')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->date('report_date');
            $table->string('quarter',255);
           
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
        Schema::dropIfExists('quarterly_report');
    }
};
