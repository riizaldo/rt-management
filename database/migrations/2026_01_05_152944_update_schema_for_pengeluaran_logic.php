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
        Schema::table('jenis_pengeluarans', function (Blueprint $table) {
            $table->foreignId('pos_anggaran_id')
                ->nullable() // Nullable dulu biar data lama aman
                ->constrained('pos_anggarans')
                ->nullOnDelete();
        });

        // 2. Tambahkan kolom pengeluaran_id di Mutasi Dana (untuk track history)
        Schema::table('mutasi_danas', function (Blueprint $table) {
            // Iuran_id kita bikin nullable (karena baris ini nanti isinya pengeluaran, bukan iuran)
            $table->foreignId('iuran_id')->nullable()->change();

            // Tambah relasi ke pengeluaran
            $table->foreignId('pengeluaran_id')
                ->nullable()
                ->constrained('pengeluarans')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
