<?php

namespace App\Http\Controllers;

use App\Models\RiwayatEvent;
use Illuminate\Http\Request;

class RiwayatEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('riwayat_event.index');
    }

    public function dataRiwayat() {
        $riwayat = RiwayatEvent::join('paket_event', 'paket_event.id_paket', '=', 'riwayat_event.id_paket')
                                ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'riwayat_event.id_pelanggan')
                                ->join('status_event', 'status_event.id_status_event', '=', 'riwayat_event.id_status_event')
                                ->select('riwayat_event.*', 'paket_event.nama_paket', 'pelanggan.nama_pelanggan', 'status_event.nama_status_event')
                                ->where('riwayat_event.id_status_event', '=', 3)
                                ->orWhere('riwayat_event.id_status_event', '=', 4)
                                ->get();
        $no = 0;
        $data = array();
        foreach ($riwayat as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->no_invoice;
            $row[] = $list->nama_event;
            $row[] = $list->nama_pelanggan;
            $row[] = $list->tanggal_mulai;
            $row[] = $list->tanggal_selesai;
            $row[] = $list->lokasi_event;
            $row[] = '<a href="' . route('invoice.downloadEvent', $list->id_riwayat_event) . '" class="btn btn-sm btn-success"><i class="fas fa-file-alt"></i></a>';
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
