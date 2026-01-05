<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [];
        $blokRumah = range('A', 'J'); // Blok A sampai J (10 blok)
        $jumlahRumahPerBlok = 12; // Nomor rumah 1 sampai 12

        // Counter untuk memberi nama unik
        $counter = 1;

        foreach ($blokRumah as $blok) {
            for ($i = 1; $i <= $jumlahRumahPerBlok; $i++) {
                $noRumah = str_pad($i, 2, '0', STR_PAD_LEFT);
                $jenisKelamin = ($counter % 2 === 0) ? 'Perempuan' : 'Laki-laki';

                $data[] = [
                    'nama' => 'Warga ' . $counter,
                    'nik' => null, // Sesuai permintaan: null
                    'kk' => null, // null
                    'jenis_kelamin' => $jenisKelamin,
                    'tanggal_lahir' => null, // null
                    'alamat' => null, // null
                    'no_rumah' => $noRumah,
                    'blok_rumah' => $blok,
                    'telepon' => null, // null
                    'foto_ktp' => null, // null
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $counter++;
            }
        }

        // Masukkan semua data ke dalam tabel
        DB::table('wargas')->insert($data);

        echo "Berhasil memasukkan " . count($data) . " data warga.\n";
    }
}
