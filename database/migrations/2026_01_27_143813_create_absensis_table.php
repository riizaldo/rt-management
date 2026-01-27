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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acara_id')->constrained('acaras')->cascadeOnDelete();
            $table->foreignId('warga_id')->constrained('wargas')->cascadeOnDelete();

            // Status kehadiran
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpa'])->default('alpa');
            $table->string('keterangan')->nullable(); // Alasan izin/sakit

            $table->timestamps();

            // Mencegah duplikasi warga di satu acara
            $table->unique(['acara_id', 'warga_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
