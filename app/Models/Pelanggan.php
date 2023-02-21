<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';

    public function penyewaan() {
        return $this->hasMany('App\Models\Penyewaan', 'id_pelanggan');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
