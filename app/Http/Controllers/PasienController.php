<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{

    public function insert(Request $req)
    {
        $validator = Validator::make($req -> all(), [
            'nama'      => 'required|string',
            'dob'       => 'required|date',
            'gender'    => 'required|string',
            'alamat'    => 'required|string',
            'phone'     => 'required|numeric'
        ]);

        if ($validator -> fails())
        {
            return response() -> json([
                'success' => false,
                'message' => $validator -> errors(),
            ]);
        }

        $pasien = new Pasien();
        $pasien -> nama     = $req -> nama;
        $pasien -> dob      = $req -> dob;
        $pasien -> gender   = $req -> gender;
        $pasien -> alamat   = $req -> alamat;
        $pasien -> phone    = $req -> phone;
        $pasien -> save();

        $data = Pasien::where('id_pasien', '=', $pasien -> id_pasien) -> first();
        return response() -> json([
            'success' => true,
            'message' => 'Data pasien berhasil ditambahkan',
            'data'    => $data
        ]);

    }

    public function update(Request $req, $id)
    {

        $validator = Validator::make($req -> all(), [
            'nama'      => 'required|string',
            'dob'       => 'required|date',
            'gender'    => 'required|string',
            'alamat'    => 'required|string',
            'phone'     => 'required|numeric'
        ]);

        if ($validator -> fails())
        {
            return response() -> json([
                'success' => false,
                'message' => $validator -> errors(),
            ]);
        }

        $pasien = Pasien::where('id_pasien', $id) -> first();
        $pasien -> nama     = $req -> nama;
        $pasien -> dob      = $req -> dob;
        $pasien -> gender   = $req -> gender;
        $pasien -> alamat   = $req -> alamat;
        $pasien -> phone    = $req -> phone;
        $pasien -> save();

        return response() -> json([
            'success' => true,
            'message' => 'Data berhasil diubah'
        ]);

    }

    public function delete($id)
    {

        $delete = Pasien::where('id_pasien', $id) -> delete();

        if ($delete) {
            return response() -> json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } else {
            return response() -> json([
                'success' => false,
                'message' => 'Data gagal dihapus'
            ]);
        }

    }

    public function getAll()
    {

        $data["count"]  = Pasien::count();
        $data["pasien"] = Pasien::get();

        return response() -> json([
            'success' => true,
            'data' => $data
        ]);

    }

    public function getById($id)
    {

        $data['pasien'] = Pasien::where('id_pasien', $id) -> get();

        return response() -> json([
            'success' => true,
            'data'    => $data
        ]);

    }

}
