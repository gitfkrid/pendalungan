<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusEvent extends Model
{
    use HasFactory;
    protected $table = 'status_event';
    protected $primaryKey = 'id_status_event';
    protected $fillable = [
        'nama_status_event'
    ];

    public $timestamps = false;

    public function event() {
        return $this->hasMany('App\Models\Event', 'id_status_event');
    }

    public function riwayat_event() {
        return $this->hasMany('App\Models\RiwayatEvent', 'id_status_event');
    }
}
