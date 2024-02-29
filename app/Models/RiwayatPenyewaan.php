<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenyewaan extends Model
{
    use HasFactory;
    protected $table = 'riwayat_penyewaan';
    protected $primaryKey = 'id_riwayat_penyewaan';

    public function detail_riwayat_penyewaan() {
        return $this->hasMany('App\Models\DetailRiwayatPenyewaan', 'id_riwayat_penyewaan');
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'id_user');
        return $this->belongsTo('App\Models\User', 'id_penyewa');
    }

    public function status_sewa() {
        return $this->belongsTo('App\Models\StatusSewa', 'id_status_sewa');
    }

    public function jaminan() {
        return $this->belongsTo('App\Models\Jaminan', 'id_jaminan');
    }
}
