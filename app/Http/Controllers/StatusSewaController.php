<?php

namespace App\Http\Controllers;

use App\Models\StatusSewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusSewaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('status_sewa.index');
    }

    public function dataStatusSewa() {
        if(Auth::user()->id_level == '1') {
            $status_sewa = StatusSewa::orderBy('id_status_sewa', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($status_sewa as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->nama_status_sewa;
                $data[] = $row;
            }
            $output = array("data" => $data);
            return response()->json($output);
        } else if (Auth::user()->id_level == '2') {
            $status_sewa = StatusSewa::orderBy('id_status_sewa', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($status_sewa as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->nama_status_sewa;
                $data[] = $row;
            }
            $output = array("data" => $data);
            return response()->json($output);
        } else {
            $status_sewa = StatusSewa::orderBy('id_status_sewa', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($status_sewa as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->nama_status_sewa;
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
        $status_sewa = new StatusSewa;
        $status_sewa->nama_status_sewa = $request['nama_status_sewa'];
        $status_sewa->save();
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
        $status_sewa = StatusSewa::find($id);
        echo json_encode($status_sewa);
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
        $status_sewa = StatusSewa::find($id);
        $status_sewa->nama_status_sewa = $request['nama_status_sewa'];
        $status_sewa->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status_sewa = StatusSewa::find($id);
        $status_sewa->delete();
    }
}
