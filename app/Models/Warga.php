<?php

namespace App\Models;

use App\Models\Iuran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warga extends Model
{

    use HasFactory;
    protected $fillable = [
        'nama',
        'nik',
        'kk',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_rumah',
        'blok_rumah',
        'telepon',
        'foto_ktp',
    ];

    public function iurans()
    {
        return $this->hasMany(Iuran::class);
    }
}
