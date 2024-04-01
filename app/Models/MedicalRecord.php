<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = ['id_pasien', 'id_dokter', 'record_datetime', 'diagnosis', 'treatment'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = "medical_records";
    protected $primaryKey = 'id_medical_record';
}
