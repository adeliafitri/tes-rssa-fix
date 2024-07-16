<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeUser extends Model
{
    use HasFactory;
    protected $table ='tipeuser';
    protected $fillable = [
        'nama_tipeuser',
        'status_tipeuser',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'fk_tipeuser_id');
    }
}
