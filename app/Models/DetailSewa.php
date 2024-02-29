<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSewa extends Model
{
    use HasFactory;
    protected $table = 'detail_sewa';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id_sewa',
        'id_barang',
        'subtotal'
    ];

    public function barang() {
        return $this->belongsTo('App\Models\Barang', 'id_barang');
    }

    public function penyewaan() {
        return $this->belongsTo('App\Models\Penyewaan', 'id_sewa');
    }
}
