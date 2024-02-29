<?php

namespace App\Http\Controllers;

use App\Models\Shortlink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShortlinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shortlink.index');
    }

    public function dataShortlink() {
        if(Auth::user()->id_level == '1') {
            $shortlink = Shortlink::orderBy('id_shortlink', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($shortlink as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = '<a href="'.route('shorten.link', $list->kode).'" target="_blank" class="btn btn-primary btn-sm">'.$list->kode.'</a>';
                $row[] = $list->keterangan;
                $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_shortlink.')"><i class="fas fa-pencil-alt"></i></a> 
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData('.$list->id_shortlink.')"><i class="fa fa-trash"></i></a>';
                $data[] = $row;
            }
            $output = array("data" => $data);
            return response()->json($output);
        } else if (Auth::user()->id_level == '2') {
            $shortlink = Shortlink::orderBy('id_shortlink', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($shortlink as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = '<a href="'.route('shorten.link', $list->kode).'" target="_blank" class="btn btn-primary btn-sm">'.$list->kode.'</a>';
                $row[] = $list->keterangan;
                $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_shortlink.')"><i class="fas fa-pencil-alt"></i></a>';
                $data[] = $row;
            }
            $output = array("data" => $data);
            return response()->json($output);
        } else {
            $shortlink = Shortlink::orderBy('id_shortlink', 'asc')->get();
            $no = 0;
            $data = array();
            foreach($shortlink as $list) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = '<a href="'.route('shorten.link', $list->kode).'" target="_blank" class="btn btn-primary btn-sm">'.$list->kode.'</a>';
                $row[] = $list->keterangan;
                $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_shortlink.')"><i class="fas fa-pencil-alt"></i></a>';
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
        $request->validate([
            'link' => 'required|url',
            'keterangan' => 'required',
        ]);
        if ($request['kode'] == '') {
            $shortlink = new Shortlink();
            $shortlink->kode = Str::random(7);
            $shortlink->link = $request['link'];
            $shortlink->keterangan = $request['keterangan'];
            $shortlink->save();
        } else {
            $shortlink = new Shortlink();
            $shortlink->kode = $request['kode'];
            $shortlink->link = $request['link'];
            $shortlink->keterangan = $request['keterangan'];
            $shortlink->save();
        }
    }

    public function shortenlink($kode) {
        $find = Shortlink::where('kode', $kode)->first();
        if ($find) {
            return redirect($find->link);
        } else {
            return redirect()->back();
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
        $shortlink = Shortlink::find($id);
        echo json_encode($shortlink);
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
        $shortlink = Shortlink::find($id);
        $shortlink->kode = $request['kode'];
        $shortlink->link = $request['link'];
        $shortlink->keterangan = $request['keterangan'];
        $shortlink->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shortlink = Shortlink::find($id);
        $shortlink->delete();
    }
}
