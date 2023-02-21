<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kategori.index');
    }

    public function dataKategori() {
        if(Auth::user()->id_level == '1') {
            $kategori = Kategori::orderBy('id_kategori', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($kategori as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->nama_kategori;
                $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_kategori.')"><i class="fas fa-pencil-alt"></i></a> 
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData('.$list->id_kategori.')"><i class="fa fa-trash"></i></a>';
                $data[] = $row;
            }
            $output = array("data" => $data);
            return response()->json($output);
        } else if (Auth::user()->id_level == '2') {
            $kategori = Kategori::orderBy('id_kategori', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($kategori as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->nama_kategori;
                $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_kategori.')"><i class="fas fa-pencil-alt"></i></a>';
                $data[] = $row;
            }
            $output = array("data" => $data);
            return response()->json($output);
        } else {
            $kategori = Kategori::orderBy('id_kategori', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($kategori as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->nama_kategori;
                $data[] = $row;
            }
            $output = array("data" => $data);
            return response()->json($output);
        }
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
        $kategori = new Kategori;
        $kategori->nama_kategori = $request['nama_kategori'];
        $kategori->save();
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
        $kategori = Kategori::find($id);
        echo json_encode($kategori);
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
        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $request['nama_kategori'];
        $kategori->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
    }
}
