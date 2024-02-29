<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketEvent;
use App\Models\Pelanggan;
use App\Models\Event;
use App\Models\StatusEvent;
use App\Models\RiwayatEvent;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paket_event = PaketEvent::all();
        $pelanggan = Pelanggan::all();
        return view('event.index', compact('paket_event', 'pelanggan'));
    }

    public function invoice() {
        $invoice = "INV/".date('Ymd')."/EVENT/".date('His');
        echo json_encode($invoice);
    }

    public function pelanggan($id) {
        $pelanggan = Pelanggan::find($id);
        echo json_encode($pelanggan);
    }

    public function paket_event($id) {
        $paket_event = PaketEvent::find($id);

        $data = array();
        $data['id_paket'] = $paket_event->id_paket;
        $data['nama_paket'] = $paket_event->nama_paket;
        $data['harga_paket_rp'] = "Rp. ".format_uang($paket_event->harga_paket);
        $data['harga_paket'] = $paket_event->harga_paket;
        echo json_encode($data);
    }

    public function ongoing() {
        $status_event = StatusEvent::all();
        return view('event.ongoing', compact('status_event'));
    }

    public function dataOngoing() {
        $event = Event::join('paket_event', 'event.id_paket', '=', 'paket_event.id_paket')
                        ->join('pelanggan', 'event.id_pelanggan', '=', 'pelanggan.id_pelanggan')
                        ->join('status_event', 'event.id_status_event', '=', 'status_event.id_status_event')
                        ->select('event.*', 'paket_event.nama_paket', 'pelanggan.nama_pelanggan', 'status_event.nama_status_event')
                        ->where('event.id_status_event', '1')
                        ->orWhere('event.id_status_event', '2')
                        ->get();
        $no = 0;
        $data = array();
        foreach($event as $list) {
            $no ++;
            $row = array();
            $row[] = $no;
            $row[] = $list->no_invoice;
            $row[] = $list->nama_event;
            $row[] = $list->tanggal_mulai;
            $row[] = $list->lokasi_event;
            $row[] = $list->id_status_event == '1' ? '<span class="badge badge-warning">'.$list->nama_status_event.'</span>' : '<span class="badge badge-success">'.$list->nama_status_event.'</span>';
            $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_event.')"><i class="far fa-money-bill-alt"></i></a>';
            $row[] = '<a href="' . route('invoice.InvoiceEvent', $list->id_event) . '" class="btn btn-sm btn-success"><i class="fas fa-file-alt"></i></a>';
            $data[] = $row;
        }
        $output = array("data" => $data);
        return response()->json($output);
    }

    public function dataEvent($id) {
        $event = Event::join('paket_event', 'event.id_paket', '=', 'paket_event.id_paket')
                        ->join('pelanggan', 'event.id_pelanggan', '=', 'pelanggan.id_pelanggan')
                        ->join('status_event', 'event.id_status_event', '=', 'status_event.id_status_event')
                        ->select('event.*', 'paket_event.nama_paket', 'pelanggan.nama_pelanggan', 'status_event.nama_status_event')
                        ->where('event.id_event', '=', $id)
                        ->first();
        echo json_encode($event);
    }

    public function changeBerlangsung (Request $request) {
        $event = Event::find($request->id);
        $event->id_status_event = $request->status;
        $event->dibayar = $request->dibayar;
        $event->update();
    }

    public function changeRiwayat(Request $request) {
        $event = Event::find($request->id);

        $riwayat = new RiwayatEvent;
        $riwayat->id_paket = $event->id_paket;
        $riwayat->no_invoice = $event->no_invoice;
        $riwayat->nama_event = $event->nama_event;
        $riwayat->tanggal_mulai = $event->tanggal_mulai;
        $riwayat->tanggal_selesai = $event->tanggal_selesai;
        $riwayat->lokasi_event = $event->lokasi_event;
        $riwayat->id_pelanggan = $event->id_pelanggan;
        $riwayat->id_status_event = '3';
        $riwayat->qty = $event->qty;
        $riwayat->subtotal = $event->subtotal;
        $riwayat->pajak = $event->pajak;
        $riwayat->total = $event->total;
        $riwayat->dibayar = $event->dibayar;
        $riwayat->save();

        $event->delete();
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
        $event = new Event;
        $event->id_paket = $request->id_paket;
        $event->no_invoice = $request->no_invoice;
        $event->nama_event = $request->nama_event;
        $event->tanggal_mulai = $request->tanggal_mulai;
        $event->tanggal_selesai = $request->tanggal_selesai;
        $event->lokasi_event = $request->lokasi_event;
        $event->id_pelanggan = $request->id_pelanggan;
        $event->id_status_event = 1;
        $event->qty = $request->qty;
        $event->subtotal = $request->subtotal;
        $event->pajak = $request->pajak;
        $event->total = $request->total;
        $event->dibayar = $request->dibayar;
        $event->save();
    }

    public function berlangsung(Request $request)
    {
        $event = new Event;
        $event->id_paket = $request->id_paket;
        $event->no_invoice = $request->no_invoice;
        $event->nama_event = $request->nama_event;
        $event->tanggal_mulai = $request->tanggal_mulai;
        $event->tanggal_selesai = $request->tanggal_selesai;
        $event->lokasi_event = $request->lokasi_event;
        $event->id_pelanggan = $request->id_pelanggan;
        $event->id_status_event = 2;
        $event->qty = $request->qty;
        $event->subtotal = $request->subtotal;
        $event->pajak = $request->pajak;
        $event->total = $request->total;
        $event->dibayar = $request->dibayar;
        $event->save();
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
