<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketEvent extends Model
{
    use HasFactory;
    protected $table = 'paket_event';
    protected $primaryKey = 'id_paket';
    protected $fillable = [
        'nama_paket',
        'deskripsi_paket',
        'harga_paket'
    ];

    public function event() {
        return $this->hasMany('App\Models\Event', 'id_paket');
    }
}
