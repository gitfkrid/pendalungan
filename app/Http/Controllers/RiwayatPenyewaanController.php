<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatPenyewaan;

class RiwayatPenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('riwayat_penyewaan.index');
    }

    public function dataRiwayat() {
        $riwayat = RiwayatPenyewaan::join('users', 'users.id', '=', 'riwayat_penyewaan.id_penyewa')
                            ->join('status_sewa', 'status_sewa.id_status_sewa', '=', 'riwayat_penyewaan.id_status_sewa')
                            ->join('jaminan', 'jaminan.id_jaminan', '=', 'riwayat_penyewaan.id_jaminan')
                            ->select('riwayat_penyewaan.*', 'users.name' ,'status_sewa.nama_status_sewa', 'jaminan.nama_jaminan')
                            ->where('riwayat_penyewaan.id_status_sewa', '=', 3)
                            ->orWhere('riwayat_penyewaan.id_status_sewa', '=', 4)
                            ->get();
        $no = 0;
        $data = array();
        foreach ($riwayat as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->no_invoice;
            $row[] = $list->name;
            $row[] = $list->tgl_sewa;
            $row[] = $list->tgl_kembali;
            $row[] = $list->nama_jaminan;
            $row[] = '<a href="' . route('invoice.downloadSewa', $list->id_riwayat_penyewaan) . '" class="btn btn-sm btn-success"><i class="fas fa-file-alt"></i></a>';
            $data[] = $row;
        }
        $output = array("data" => $data);
        return response()->json($output);
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
