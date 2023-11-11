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
        Schema::table('weekly_report', function (Blueprint $table) {
            $table->text('objek_monitoring')->nullable()->after('report_id');
            $table->text('hasil_evaluasi')->nullable()->after('report_date');
            $table->text('rekomendasi')->nullable()->after('hasil_evaluasi');
            $table->text('tindak_lanjut')->nullable()->after('rekomendasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weekly_report', function (Blueprint $table) {
            //
        });
    }
};
