<?php

namespace App\Http\Controllers;

use App\Models\JobdescEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobdescEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('jobdesc_event.index');
    }

    public function dataJobdescEvent() {
        if(Auth::user()->id_level == '1') {
            $jobdesc_event = JobdescEvent::orderBy('id_jobdesc', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($jobdesc_event as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->nama_jobdesc;
                $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_jobdesc.')"><i class="fas fa-pencil-alt"></i></a> 
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData('.$list->id_jobdesc.')"><i class="fa fa-trash"></i></a>';
                $data[] = $row;
            }
            $output = array("data" => $data);
            return response()->json($output);
        } else if (Auth::user()->id_level == '2') {
            $jobdesc_event = JobdescEvent::orderBy('id_jobdesc', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($jobdesc_event as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->nama_jobdesc;
                $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_jobdesc.')"><i class="fas fa-pencil-alt"></i></a>';
                $data[] = $row;
            }
            $output = array("data" => $data);
            return response()->json($output);
        } else {
            $jobdesc_event = JobdescEvent::orderBy('id_jobdesc', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($jobdesc_event as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->nama_jobdesc;
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
        $jobdesc_event = new JobdescEvent();
        $jobdesc_event->nama_jobdesc = $request['nama_jobdesc'];
        $jobdesc_event->save();
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
        $jobdesc_event = JobdescEvent::find($id);
        echo json_encode($jobdesc_event);
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
        $jobdesc_event = JobdescEvent::find($id);
        $jobdesc_event->nama_jobdesc = $request['nama_jobdesc'];
        $jobdesc_event->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobdesc_event = JobdescEvent::find($id);
        $jobdesc_event->delete();
    }
}
