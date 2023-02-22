<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required',
            'alamat_pelanggan' => 'required',
            'hp_pelanggan' => 'required|numeric|digits_between:10,13|unique:pelanggan,hp_pelanggan',
            'email_pelanggan' => 'required|email',
            'username_pelanggan' => 'required|unique:pelanggan,username_pelanggan',
            'password_pelanggan' => 'required',
            'c_password_pelanggan' => 'required|same:password_pelanggan'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Register Gagal, cek kembali data yang anda masukkan',
                'data' => $validator->errors()
            ], 400);
        }

        $data = $request->all();
        $data['password_pelanggan'] = bcrypt($data['password_pelanggan']);
        unset($data['c_password_pelanggan']);
        $pelanggan = Pelanggan::create($data);

        if ($pelanggan) {
            return response()->json([
                'success' => true,
                'message' => 'Register Berhasil',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Register Gagal, coba lagi nanti',
                'data' => ''
            ], 500);
        }

    }
}
