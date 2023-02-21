<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    
    public function kategori() {
        return $this->belongsTo('App\Models\Kategori', 'id_kategori');
    }

    public function detail_sewa() {
        return $this->hasMany('App\Models\DetailSewa', 'id_barang');
    }
}
