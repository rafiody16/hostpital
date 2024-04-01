<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Validator;

class MedicalRecordController extends Controller
{

    public function insert(Request $req)
    {
        $validator = Validator::make($req -> all(), [
            'id_pasien'         => 'required|numeric',
            'id_dokter'         => 'required|numeric',
            'record_datetime'   => 'required|date',
            'diagnosis'         => 'required|string',
            'treatment'         => 'required|string'
        ]);

        if ($validator -> fails()) {
            return response() -> json([
                'success' => false,
                'message' => $validator -> errors()
            ]);
        }

        $mrc = new MedicalRecord();
        $mrc -> id_pasien         = $req -> id_pasien;
        $mrc -> id_dokter         = $req -> id_dokter;
        $mrc -> record_datetime   = $req -> record_datetime;
        $mrc -> diagnosis         = $req -> diagnosis;
        $mrc -> treatment         = $req -> treatment;

        $data = MedicalRecord::where('id_medical_record', '=', $req -> id_medical_record) -> first();
        return response() -> json([
            'success' => true,
            'message' => 'data berhasil ditambahkan',
            'data' => $data
        ]);
    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req -> all(), [
            'id_pasien'         => 'required|numeric',
            'id_dokter'         => 'required|numeric',
            'record_datetime'   => 'required|date',
            'diagnosis'         => 'required|string',
            'treatment'         => 'required|string'
        ]);

        if ($validator -> fails()) {
            return response() -> json([
                'success' => false,
                'message' => $validator -> errors()
            ]);
        }

        $mrc = MedicalRecord::where('id_medical_record', $id) -> first();
        $mrc -> id_pasien         = $req -> id_pasien;
        $mrc -> id_dokter         = $req -> id_dokter;
        $mrc -> record_datetime   = $req -> record_datetime;
        $mrc -> diagnosis         = $req -> diagnosis;
        $mrc -> treatment         = $req -> treatment;
        $mrc -> save();

        return response() -> json([
            'success' => true,
            'message' => 'data berhasil diubah'
        ]);

    }

    public function delete($id)
    {
        $delete = MedicalRecord::where('id_medical_record', $id) -> delete();

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
        $data["count"] = MedicalRecord::count();
        $data["medicalrecord"] = MedicalRecord::get();

        return response() -> json([
            'success' => true,
            'data'    => $data
        ]);
    }

    public function getById($id)
    {
        $data['medicalrecord'] = MedicalRecord::where('id_medical_record', $id) -> get();

        return response() -> json([
            'success' => true,
            'data'    => $data
        ]);
    }
}
