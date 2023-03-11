<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'event';
    protected $primaryKey = 'id_event';

    public function paket_event() {
        return $this->belongsTo('App\Models\PaketEvent', 'id_paket');
    }

    public function status_event() {
        return $this->belongsTo('App\Models\StatusEvent', 'id_status_event');
    }

    public function pelanggan() {
        return $this->belongsTo('App\Models\Pelanggan', 'id_pelanggan');
    }
}
