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
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_pengeluaran_id')
                ->constrained('jenis_pengeluarans')
                ->cascadeOnDelete();

            $table->decimal('nominal', 17, 2); // Nilai nominal pengeluaran
            $table->date('tanggal')->nullable(); // Tanggal pengeluaran
            $table->string('keterangan')->nullable(); // Keterangan atau deskripsi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluarans');
    }
};
