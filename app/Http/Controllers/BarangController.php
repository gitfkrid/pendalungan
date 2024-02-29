<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('barang.index', compact('kategori'));
    }

    public function dataBarang() {
        if(Auth::user()->id_level == '1') {
            $barang = Barang::join('kategori', 'kategori.id_kategori', '=', 'barang.id_kategori')
                        ->orderBy('id_barang', 'desc')
                        ->get();
            $no = 0;
            $data = array();
            foreach ($barang as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->kode_barang;
                $row[] = $list->nama_barang;
                $row[] = $list->serial_number;
                $row[] = "Rp. ". format_uang($list->harga_sewa);
                $row[] = $list->status == '1' ? '<span class="badge badge-success">Tersedia</span>' : '<span class="badge badge-danger">Tidak Tersedia</span>';
                $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_barang.')"><i class="fas fa-pencil-alt"></i></a> 
                <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData('.$list->id_barang.')"><i class="fa fa-trash"></i></a>';
                $data[] = $row;
            }
            return DataTables::of($data)->escapeColumns([])->make(true);
        } else if (Auth::user()->id_level == '2') {
            $barang = Barang::join('kategori', 'kategori.id_kategori', '=', 'barang.id_kategori')
                        ->orderBy('id_barang', 'desc')
                        ->get();
            $no = 0;
            $data = array();
            foreach ($barang as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->kode_barang;
                $row[] = $list->nama_barang;
                $row[] = $list->serial_number;
                $row[] = "Rp. ". format_uang($list->harga_sewa);
                $row[] = $list->status == '1' ? '<span class="badge badge-success">Tersedia</span>' : '<span class="badge badge-danger">Tidak Tersedia</span>';
                $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_barang.')"><i class="fas fa-pencil-alt"></i></a>';
                $data[] = $row;
            }
            return DataTables::of($data)->escapeColumns([])->make(true);
        } else {
            $barang = Barang::join('kategori', 'kategori.id_kategori', '=', 'barang.id_kategori')
                        ->orderBy('id_barang', 'desc')
                        ->get();
            $no = 0;
            $data = array();
            foreach ($barang as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->kode_barang;
                $row[] = $list->nama_barang;
                $row[] = $list->serial_number;
                $row[] = "Rp. ". format_uang($list->harga_sewa);
                $row[] = $list->status == '1' ? '<span class="badge badge-success">Tersedia</span>' : '<span class="badge badge-danger">Tidak Tersedia</span>';
                $row[] = '';
                $data[] = $row;
            }
            return DataTables::of($data)->escapeColumns([])->make(true);
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
        $jml = Barang::where('id_barang', $request->id_barang)->count();
        if($jml < 1) {
            $barang = new Barang;
            $barang->id_kategori = $request->id_kategori;
            $barang->kode_barang = $request->kode_barang;
            $barang->nama_barang = $request->nama_barang;
            $barang->serial_number = $request->serial_number;
            $barang->harga_sewa = $request->harga_sewa;
            $barang->save();
            echo json_encode(array('msg' => 'success'));
        } else {
            return response()->json(['error' => 'Data sudah ada']);
            echo json_encode(array('msg' => 'failed'));
        }
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
        $barang = Barang::find($id);
        echo json_encode($barang);
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
        $barang = Barang::find($id);
        $barang->id_kategori = $request->id_kategori;
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->serial_number = $request->serial_number;
        $barang->harga_sewa = $request->harga_sewa;
        $barang->update();
        echo json_encode(array('msg' => 'success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();
    }
}
