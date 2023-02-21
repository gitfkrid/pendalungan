<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'nama_kategori',
    ];

    public $timestamps = false;

    public function barang() {
        return $this->hasMany('App\Models\Barang', 'id_kategori');
    }
}
