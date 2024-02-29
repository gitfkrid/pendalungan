<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PenyewaController extends Controller
{
    public function index() {
        return view ('penyewa.index');
    }

    public function dataPenyewa() {
        $penyewa = User::join('level', 'level.id_level', '=', 'users.id_level')
                    ->where('level.id_level', '=', 4)
                    ->orderBy('id', 'desc')
                    ->get();
        $no = 0;
        $data = array();
        foreach ($penyewa as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->name;
            $row[] = $list->email;
            $row[] = $list->hp;
            $row[] = '<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData('.$list->id.')"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'hp' => 'required|numeric|digits_between:10,13|unique:users,hp',
            'alamat' => 'required',
            'password' => 'required'
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
        User::create($data);
    }

    Public function destroy($id) {
        $user = User::find($id);
        $user->delete();
    }
}
