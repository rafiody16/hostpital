<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use Illuminate\Support\Facades\Validator;

class DokterController extends Controller
{

    public function insert(Request $req)
    {

        $validator = Validator::make($req -> all(), [
            'id_user'         => 'required|numeric',
            'nama'            => 'required|string',
            'spesialisasi'    => 'required|string',
            'phone'           => 'required|numeric'
        ]);

        if ($validator -> fails()) {
            return response() -> json([
                'success' => false,
                'message' => $validator -> errors()
            ]);
        }

        $dokter = new Dokter();
        $dokter -> id_user      = $req -> id_user;
        $dokter -> nama         = $req -> nama;
        $dokter -> spesialisasi = $req -> spesialisasi;
        $dokter -> phone        = $req -> phone;
        $dokter -> save();

        $data = Dokter::where('id_dokter', '=', $dokter -> id_dokter) -> first();
        return response() -> json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan',
            'data'    => $data
        ]);

    }

    public function update(Request $req, $id)
    {

        $validator = Validator::make($req -> all(), [
            'id_user'         => 'required|numeric',
            'nama'            => 'required|string',
            'spesialisasi'    => 'required|string',
            'phone'           => 'required|numeric'
        ]);

        if ($validator -> fails()) {
            return response() -> json([
                'success' => false,
                'message' => $validator -> errors()
            ]);
        }

        $dokter = Dokter::where('id_dokter', $id) -> first();
        $dokter -> id_user      = $req -> id_user;
        $dokter -> nama         = $req -> nama;
        $dokter -> spesialisasi = $req -> spesialisasi;
        $dokter -> phone        = $req -> phone;
        $dokter -> save();

        return response() -> json([
            'success' => true,
            'message' => 'Data berhasil diubah',
        ]);

    }

    public function delete($id)
    {

        $delete = Dokter::where('id_dokter', $id) -> delete();

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

        $data["count"]  = Dokter::count();
        $data["dokter"] = Dokter::get();

        return response() -> json([
            'success' => true,
            'data' => $data
        ]);

    }

    public function getById($id)
    {

        $data['dokter'] = Dokter::where('id_dokter', $id) -> get();

        return response() -> json([
            'success' => true,
            'data'    => $data
        ]);

    }

}
