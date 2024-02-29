<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusSewa extends Model
{
    use HasFactory;
    protected $table = 'status_sewa';
    protected $primaryKey = 'id_status_sewa';
    protected $fillable = [
        'nama_status_sewa',
    ];

    public $timestamps = false;

    public function penyewaan() {
        return $this->hasMany('App\Models\Penyewaan', 'id_status_sewa');
    }

    public function riwayat_penyewaan() {
        return $this->hasMany('App\Models\RiwayatPenyewaan', 'id_status_sewa');
    }
}
