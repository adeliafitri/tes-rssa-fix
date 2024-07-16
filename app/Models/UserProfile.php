<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $table ='userprofile';
    protected $fillable = [
        'nama_userprofile',
        'alamat_userprofile',
        'status_userprofile',
        'fk_user_id',
        'fk_provinsi_id',
        'fk_kota_id',
        'fk_kecamatan_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

}
