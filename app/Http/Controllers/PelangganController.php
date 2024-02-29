<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pelanggan.index');
    }

    public function dataPelanggan() {
        $pelanggan = Pelanggan::orderBy('id_pelanggan', 'desc')->get();
        $no = 0;
        $data = array();
        foreach ($pelanggan as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->nama_pelanggan;
            $row[] = $list->alamat_pelanggan;
            $row[] = $list->hp_pelanggan;
            $row[] = $list->email_pelanggan;
            $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_pelanggan.')"><i class="fas fa-pencil-alt"></i></a> 
            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData('.$list->id_pelanggan.')"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pelanggan = new Pelanggan;
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->alamat_pelanggan = $request->alamat_pelanggan;
        $pelanggan->hp_pelanggan = $request->hp_pelanggan;
        $pelanggan->email_pelanggan = $request->email_pelanggan;
        $pelanggan->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);
        echo json_encode($pelanggan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->alamat_pelanggan = $request->alamat_pelanggan;
        $pelanggan->hp_pelanggan = $request->hp_pelanggan;
        $pelanggan->email_pelanggan = $request->email_pelanggan;
        $pelanggan->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();
    }
}
