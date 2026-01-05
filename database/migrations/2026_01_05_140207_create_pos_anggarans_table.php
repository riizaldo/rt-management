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
        Schema::create('pos_anggarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Contoh: "Kas RT", "Dana Sosial"
            $table->string('kode')->nullable(); // Contoh: "SOC", "OPS"
            $table->timestamps();
        });

        // Tabel Pivot/Aturan: Mengatur cara split dari Jenis Iuran ke Pos Anggaran
        Schema::create('aturan_alokasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_iuran_id')->constrained('jenis_iurans')->cascadeOnDelete();
            $table->foreignId('pos_anggaran_id')->constrained('pos_anggarans')->cascadeOnDelete();

            // Tipe: 'persen' (misal 10%) atau 'fix' (misal Rp 5000)
            $table->enum('tipe', ['persen', 'fix'])->default('persen');
            $table->decimal('nilai', 17, 2); // Nilai persen atau nominalnya

            $table->timestamps();
        });

        // Tabel Log/History: Mencatat uang yang benar-benar masuk ke pos (Hasil Dropping)
        Schema::create('mutasi_danas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iuran_id')->constrained('iurans')->cascadeOnDelete(); // Sumber uang
            $table->foreignId('pos_anggaran_id')->constrained('pos_anggarans')->cascadeOnDelete(); // Tujuan uang
            $table->decimal('nominal', 17, 2); // Hasil hitungan yang masuk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_anggarans');
        Schema::dropIfExists('aturan_alokasis');
        Schema::dropIfExists('mutasi_danas');
    }
};
