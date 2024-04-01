<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{

    public function insert(Request $req)
    {
        $validator = Validator::make($req -> all(), [
            'id_pasien'             => 'required|numeric',
            'id_dokter'             => 'required|numeric',
            'appointment_datetime'  => 'required|date',
        ]);
    }
}
