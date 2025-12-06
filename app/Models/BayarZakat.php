<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BayarZakat extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'warga_id',
        'nama_KK',
        'nomor_KK',
        'jumlah_tanggungan',
        'jenis_bayar',
        'status',
        'bayar_beras',
        'bayar_uang',
        'total_zakat',
        'tahun_hijriah',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}
