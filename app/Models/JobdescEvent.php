<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobdescEvent extends Model
{
    use HasFactory;
    protected $table = 'jobdesc_event';
    protected $primaryKey = 'id_jobdesc';
    protected $fillable = [
        'nama_jobdesc',
    ];

    public $timestamps = false;
    
    public function detail_event() {
        return $this->hasMany('App\Models\DetailEvent', 'id_jobdesc');
    }
}
