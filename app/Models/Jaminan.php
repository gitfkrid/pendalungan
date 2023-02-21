<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jaminan extends Model
{
    use HasFactory;
    protected $table = 'jaminan';
    protected $primaryKey = 'id_jaminan';
    protected $fillable = [
        'nama_jaminan',
    ];

    public $timestamps = false;

    public function penyewaan() {
        return $this->hasMany('App\Models\Penyewaan', 'id_jaminan');
    }
}
