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

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Login Gagal',
                'data' => $validator->errors()
            ], 400);
        }

        $pelanggan = Pelanggan::where('username_pelanggan', $request->username)->first();
        $success['token'] = $pelanggan->createToken('SIBanjir')->plainTextToken;
        $success['nama_pelanggan'] = $pelanggan->nama_pelanggan;

        if ($pelanggan) {
            if (password_verify($request->password, $pelanggan->password_pelanggan)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login Berhasil',
                    'data' => $success
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Login Gagal, password salah',
                    'data' => ''
                ], 500);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Login Gagal, username tidak ditemukan',
                'data' => ''
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        if ($request) {
            return response()->json([
                'success' => true,
                'message' => 'Logout Berhasil',
                'data' => ''
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Logout Gagal',
                'data' => ''
            ], 500);
        }
    }

    public function profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uuid' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Gagal',
                'data' => $validator->errors()
            ], 400);
        }

        $pelanggan = Pelanggan::where('uuid', $request->uuid)->first();
        $data['uuid'] = $pelanggan->uuid;
        $data['nama_pelanggan'] = $pelanggan->nama_pelanggan;
        $data['username_pelanggan'] = $pelanggan->username_pelanggan;
        $data['alamat_pelanggan'] = $pelanggan->alamat_pelanggan;
        $data['hp_pelanggan'] = $pelanggan->hp_pelanggan;
        $data['email_pelanggan'] = $pelanggan->email_pelanggan;

        if($pelanggan){
            return response()->json([
                'success' => true,
                'message' => 'Berhasil',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal',
                'data' => ''
            ], 500);
        }
    }

}
