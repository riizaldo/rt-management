<?php

namespace App\Models;

use App\Models\AturanAlokasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisIuran extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'nominal', 'is_active'];

    public function aturanAlokasis()
    {
        return $this->hasMany(AturanAlokasi::class);
    }
}
