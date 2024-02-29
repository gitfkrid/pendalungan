<?php

namespace App\Http\Controllers;

use App\Models\StatusEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('status_event.index');
    }

    public function dataStatusEvent() {
        if(Auth::user()->id_level == '1') {
            $status_event = StatusEvent::orderBy('id_status_event', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($status_event as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->nama_status_event;
                $data[] = $row;
            }
            $output = array("data" => $data);
            return response()->json($output);
        } else if (Auth::user()->id_level == '2') {
            $status_event = StatusEvent::orderBy('id_status_event', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($status_event as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->nama_status_event;
                $data[] = $row;
            }
            $output = array("data" => $data);
            return response()->json($output);
        } else {
            $status_event = StatusEvent::orderBy('id_status_event', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($status_event as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $list->nama_status_event;
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
        $status_event = new StatusEvent;
        $status_event->nama_status_event = $request['nama_status_event'];
        $status_event->save();
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
        $status_event = StatusEvent::find($id);
        echo json_encode($status_event);
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
        $status_event = StatusEvent::find($id);
        $status_event->nama_status_event = $request['nama_status_event'];
        $status_event->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status_event = StatusEvent::find($id);
        $status_event->delete();
    }
}
