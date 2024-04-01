<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['id_pasien', 'id_dokter', 'appointment_datetime', 'status'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = "appointments";
    protected $primaryKey = 'id_appointment';
}
