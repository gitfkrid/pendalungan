<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatEvent extends Model
{
    use HasFactory;
    protected $table = 'riwayat_event';
    protected $primaryKey = 'id_riwayat_event';
}
