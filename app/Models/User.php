<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'hp',
        'alamat',
        'id_level',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function level() {
        return $this->belongsTo('App\Models\Level', 'id_level');
    }

    public function penyewaan() {
        return $this->hasMany('App\Models\Penyewaan', 'id_user');
        return $this->hasMany('App\Models\Penyewaan', 'id_penyewa');
    }

    public function detail_event() {
        return $this->hasMany('App\Models\DetailEvent', 'id_user');
    }

    public function riwayat_penyewaan() {
        return $this->hasMany('App\Models\RiwayatPenyewaan', 'id_user');
        return $this->hasMany('App\Models\RiwayatPenyewaan', 'id_penyewa');
    }

    public function detail_riwayat_event() {
        return $this->hasMany('App\Models\DetailRiwayatEvent', 'id_user');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

}
