<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $fillable = ['id_user', 'nama', 'spesialisasi', 'phone'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = "dokters";
    protected $primaryKey = 'id_dokter';

    public function user()
    {
        return $this -> belongsTo('app\Models\User', 'id', 'id_user');
    }
}
