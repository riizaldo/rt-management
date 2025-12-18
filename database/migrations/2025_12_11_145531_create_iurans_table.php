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
        Schema::create('iurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained()->cascadeOnDelete();
            $table->foreignId('jenis_iuran_id')->constrained('jenis_iurans')->cascadeOnDelete();
            $table->decimal('nominal', 17, 2);
            $table->integer('bulan');
            $table->year('tahun');
            $table->enum('status', ['lunas', 'belum'])->default('belum');
            $table->string('bukti_bayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iurans');
    }
};
