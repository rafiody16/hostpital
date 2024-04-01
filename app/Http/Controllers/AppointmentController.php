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

        if ($validator -> fails()) {
            return response() -> json([
                'success' => false,
                'message' => $validator -> errors()
            ]);
        }

        $apnmt = new Appointment();
        $apnmt -> id_pasien         = $req -> id_pasien;
        $apnmt -> id_dokter         = $req -> id_dokter;
        $apnmt -> appointment_date  = $req -> appointment_date;
        $apnmt -> status            = 'terjadwal';

        $data = Appointment::where('id_appointment', '=', $req -> id_appointment) -> first();
        return response() -> json([
            'success' => true,
            'message' => 'Berhasil menambahkan data',
            'data' => $data
        ]);
    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req -> all(), [
            'id_pasien'             => 'required|numeric',
            'id_dokter'             => 'required|numeric',
            'appointment_datetime'  => 'required|date',
            'status'                => 'required|string'
        ]);

        if ($validator -> fails()) {
            return response() -> json([
                'success' => false,
                'message' => $validator -> errors()
            ]);
        }

        $apnmt = Appointment::where('id_appointment', $id) -> first();
        $apnmt -> id_pasien         = $req -> id_pasien;
        $apnmt -> id_dokter         = $req -> id_dokter;
        $apnmt -> appointment_date  = $req -> appointment_date;
        $apnmt -> status            = $req -> status;
        $apnmt -> save();

        return response() -> json([
            'success' => true,
            'message' => 'Data berhasil diubah'
        ]);
    }

    public function delete($id)
    {
        $delete = Appointment::where('id_appointment', $id) -> delete();

        if ($delete) {
            return response() -> json([
                'success' => true,
                'message' => 'data berhasil dihapus'
            ]);
        } else {
            return response() -> json([
                'success' => false,
                'message' => 'data gagal dihapus'
            ]);
        }
    }

    public function getAll()
    {
        $data["count"] = Appointment::count();
        $data["appointment"] = Appointment::get();

        return response() -> json([
            'success' => true,
            'data'    => $data
        ]);
    }

    public function getById($id)
    {
        $data['appointment'] = Appointment::where('id_appointment', $id) -> get();

        return response() -> json([
            'success' => true,
            'data'    => $data
        ]);
    }

}
