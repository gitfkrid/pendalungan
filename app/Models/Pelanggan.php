<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Pelanggan extends Model
{
    use HasApiTokens, HasFactory;
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $fillable = [
        'nama_pelanggan',
        'alamat_pelanggan',
        'hp_pelanggan',
        'email_pelanggan',
    ];

    public function event() {
        return $this->hasMany('App\Models\Event', 'id_pelanggan');
    }

    public function riwayat_event() {
        return $this->hasMany('App\Models\RiwayatEvent', 'id_pelanggan');
    }
}
