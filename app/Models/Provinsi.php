<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table ='provinsi';
    protected $fillable = [
        'nama_provinsi',
        'status_provinsi',
    ];

    public function kota()
    {
        return $this->hasMany(Kota::class, 'fk_kota_id');
    }

    public function user()
    {
        return $this->hasMany(UserProfile::class, 'fk_kota_id');
    }
}
