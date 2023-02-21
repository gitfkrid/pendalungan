<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenyewaan extends Model
{
    use HasFactory;
    protected $table = 'riwayat_penyewaan';
    protected $primaryKey = 'id_riwayat_penyewaan';
}
