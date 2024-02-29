<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Level;

class UserController extends Controller
{
    public function index() {
        $user = Auth::user();
        $level = Level::join('users', 'level.id_level', '=', 'users.id_level')
            ->select('level.nama_level')
            ->where('users.id_level', $user->id_level)
            ->first();
        return view ('profile.index', compact('user', 'level'));
    }

    public function edit() {
        $user = Auth::user();
        echo json_encode($user);
    }

    public function updateProfile(Request $request, $id) {
        $user = User::find($id);

        if(!empty($request->password)) {
            if(Hash::check($request->old_password, $user->password)) {
                $user->password = bcrypt($request->password);
            } else {
                $msg = "error";
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->hp = $request->hp;
        $user->alamat = $request->alamat;

        $data = $request->all();

        if($user->update()) {
            return response()->json([
                'success' => true,
                'message' => 'Edit Profile Berhasil',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Edit Profile Gagal',
                'data' => ''
            ], 500);
        }
    }
}
