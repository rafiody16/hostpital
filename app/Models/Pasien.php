<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = ['nama', 'dob', 'gender', 'alamat', 'phone'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = "pasiens";
    protected $primaryKey = 'id_pasien';
}
