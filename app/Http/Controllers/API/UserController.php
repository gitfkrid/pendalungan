<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'hp' => 'required|numeric|digits_between:10,13|unique:users,hp',
            'alamat' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Register Gagal, cek kembali data yang anda masukkan',
                'data' => $validator->errors()
            ], 400);
        }

        $data = $request->all();
        $data['id_level'] = 4;
        $data['password'] = bcrypt($data['password']);
        unset($data['c_password']);
        $pelanggan = User::create($data);

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
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Login Gagal',
                'data' => $validator->errors()
            ], 400);
        }

        $user = User::where('email', $request->email)->first();
        $success['token'] = $user->createToken('Pendalungan')->accessToken;
        $success['uuid'] = $user->uuid;
        $success['id'] = $user->id;
        
        if($success) {
            if (password_verify($request->password, $user->password)) {
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

        $user = User::join('level', 'users.id_level', '=', 'level.id_level')
        ->where('uuid', $request->uuid)->first();
        $data['uuid'] = $user->uuid;
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['hp'] = $user->hp;
        $data['alamat'] = $user->alamat;
        $data['level'] = $user->nama_level;

        if($user){
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

    public function editprofile(Request $request, $uuid) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'hp' => 'required|numeric|digits_between:10,13',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Edit Profile gagal, cek kembali data yang anda masukkan',
                'data' => $validator->errors()
            ], 400);
        }

        $data = $request->all();
        $pelanggan = User::where('uuid', $uuid)->first();
        $pelanggan->name = $request['name'];
        $pelanggan->alamat = $request['alamat'];
        $pelanggan->email = $request['email'];
        $pelanggan->hp = $request['hp'];

        if ($pelanggan->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Edit Profile Berhasil',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Edit Profile Gagal, coba lagi nanti',
                'data' => ''
            ], 500);
        }
    }

    public function editpassword(Request $request, $uuid) {
        $validator = Validator::make($request->all(), [
            'password_lama' => 'required',
            'password_baru' => 'required',
            'c_password_baru' => 'required|same:password_baru',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Edit Password gagal, cek kembali data yang anda masukkan',
                'data' => $validator->errors()
            ], 400);
        }

        if(!Hash::check($request->password_lama, auth()->user()->password)){
            return response()->json([
                'success' => false,
                'message' => 'Edit Password gagal, password lama tidak sama',
            ]);
        }

        $pelanggan = User::where('uuid', $uuid)->first();
        $pelanggan->password = bcrypt($request['password_baru']);

        if ($pelanggan->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Edit Password Berhasil',
                'data' => ''
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Edit Password Gagal, coba lagi nanti',
                'data' => ''
            ], 500);
        }
    }

}
