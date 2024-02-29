<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRiwayatPenyewaan extends Model
{
    use HasFactory;
    protected $table = 'detail_riwayat_penyewaan';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id_riwayat_penyewaan',
        'id_barang',
        'subtotal'
    ];

    public function riwayat_penyewaan() {
        return $this->belongsTo('App\Models\RiwayatPenyewaan', 'id_riwayat_penyewaan');
    }

    public function barang() {
        return $this->belongsTo('App\Models\Barang', 'id_barang');
    }
}
