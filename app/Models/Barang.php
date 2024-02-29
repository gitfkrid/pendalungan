<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'kode_barang',
        'id_kategori',
        'nama_barang',
        'serial_number',
        'harga_sewa',
        'status'
    ];
    
    public function kategori() {
        return $this->belongsTo('App\Models\Kategori', 'id_kategori');
    }

    public function detail_sewa() {
        return $this->hasMany('App\Models\DetailSewa', 'id_barang');
    }

    public function detail_riwayat_penyewaan() {
        return $this->hasMany('App\Models\DetailRiwayatPenyewaan', 'id_barang');
    }
}
