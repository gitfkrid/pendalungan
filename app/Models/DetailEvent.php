<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEvent extends Model
{
    use HasFactory;
    protected $table = 'detail_event';

    public function event() {
        return $this->belongsTo('App\Models\Event', 'id_event');
    }

    public function users() {
        return $this->belongsTo('App\Models\User', 'id_user');
    }

    public function jobdesc_event() {
        return $this->belongsTo('App\Models\JobdescEvent', 'id_jobdesc');
    }
}
