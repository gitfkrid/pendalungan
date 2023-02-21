<?php

namespace App\Http\Controllers;

use App\Models\Jaminan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JaminanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jaminan.index');
    }

    public function dataJaminan() {
        if(Auth::user()->id_level == '1') {
            $jaminan = Jaminan::orderBy('id_jaminan', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($jaminan as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->nama_jaminan;
                $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_jaminan.')"><i class="fas fa-pencil-alt"></i></a> 
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData('.$list->id_jaminan.')"><i class="fa fa-trash"></i></a>';
                $data[] = $row;
            }
            $output = array("data" => $data);
            return response()->json($output);
        } else if (Auth::user()->id_level == '2') {
            $jaminan = Jaminan::orderBy('id_jaminan', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($jaminan as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->nama_jaminan;
                $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_jaminan.')"><i class="fas fa-pencil-alt"></i></a>';
                $data[] = $row;
            }
            $output = array("data" => $data);
            return response()->json($output);
        } else {
            $jaminan = Jaminan::orderBy('id_jaminan', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($jaminan as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->nama_jaminan;
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
        $jaminan = new Jaminan;
        $jaminan->nama_jaminan = $request['nama_jaminan'];
        $jaminan->save();
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
        $jaminan = Jaminan::find($id);
        echo json_encode($jaminan);
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
        $jaminan = Jaminan::find($id);
        $jaminan->nama_jaminan = $request['nama_jaminan'];
        $jaminan->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jaminan = Jaminan::find($id);
        $jaminan->delete();
    }
}
