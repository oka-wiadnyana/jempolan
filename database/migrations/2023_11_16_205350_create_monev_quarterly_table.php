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
        Schema::create('monev_quarterly', function (Blueprint $table) {
            $table->id();
            $table->integer('report_id');
            $table->string('object_name',500);
            $table->text('kesesuaian')->nullable();
            $table->text('ketidaksesuaian')->nullable();
            $table->text('tindakan_perbaikan')->nullable();
            $table->text('penanggung_jawab')->nullable();
            $table->date('close_date')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monev_quarterly');
    }
};
