<?php

namespace App\Http\Controllers;

use App\Models\PaketEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaketEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('paket_event.index');
    }

    public function dataPaketEvent() {
        if(Auth::user()->id_level == '1') {
            $paket_event = PaketEvent::orderBy('id_paket', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($paket_event as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->kode_paket;
                $row[] = $list->nama_paket;
                $row[] = "Rp. ". format_uang($list->harga_paket);
                $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_paket.')"><i class="fas fa-pencil-alt"></i></a> 
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData('.$list->id_paket.')"><i class="fa fa-trash"></i></a>';
                $data[] = $row;
            }
            $output = array("data" => $data);
            return response()->json($output);
        } else if (Auth::user()->id_level == '2') {
            $paket_event = PaketEvent::orderBy('id_paket', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($paket_event as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->kode_paket;
                $row[] = $list->nama_paket;
                $row[] = "Rp. ". format_uang($list->harga_paket);
                $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_paket.')"><i class="fas fa-pencil-alt"></i></a>';
                $data[] = $row;
            }
            $output = array("data" => $data);
            return response()->json($output);
        } else {
            $paket_event = PaketEvent::orderBy('id_paket', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($paket_event as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->kode_paket;
                $row[] = $list->nama_paket;
                $row[] = "Rp. ". format_uang($list->harga_paket);
                $row[] = '';
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
        $paket_event = new PaketEvent;
        $paket_event->kode_paket = $request['kode_paket'];
        $paket_event->nama_paket = $request['nama_paket'];
        $paket_event->harga_paket = $request['harga_paket'];
        $paket_event->save();
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
        $paket_event = PaketEvent::find($id);
        echo json_encode($paket_event);
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
        $paket_event = PaketEvent::find($id);
        $paket_event->kode_paket = $request['kode_paket'];
        $paket_event->nama_paket = $request['nama_paket'];
        $paket_event->harga_paket = $request['harga_paket'];
        $paket_event->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paket_event = PaketEvent::find($id);
        $paket_event->delete();
    }
}
