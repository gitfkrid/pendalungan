<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailRiwayatPenyewaan;
use App\Models\DetailSewa;
use App\Models\Jaminan;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Penyewaan;
use App\Models\RiwayatPenyewaan;
use App\Models\StatusSewa;
use App\Models\User;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penyewa = User::where('id_level', '4')->get();
        $jaminan = Jaminan::all();
        return view ('penyewaan.index', compact('penyewa', 'jaminan'));
    }

    public function detailPenyewa($id) {
        $penyewa = User::find($id);
        echo json_encode($penyewa);
    }

    public function detailBarang($id) {
        $barang = Barang::find($id);

        $data = array();
        $data['id_barang'] = $id;
        $data['nama_barang'] = $barang->nama_barang;
        $data['harga_sewa_rp'] = "Rp. ". format_uang($barang->harga_sewa);
        $data['harga_sewa'] = $barang->harga_sewa;
        $data['serial_number'] = $barang->serial_number;
        
        echo json_encode($data);
    }

    public function chekoutBarang (Request $request) {
        $keranjang = new Keranjang;
        $keranjang->id_barang = $request->barang;
        $keranjang->subtotal = $request->subtotal;
        $keranjang->id_user = Auth()->user()->id;

        if($keranjang->save()) {
            $barang = Barang::find($request->barang);
            $barang->status = '0';
            $barang->update();
        }
    }

    public function dataKeranjang() {
        $keranjang = Keranjang::join('barang', 'barang.id_barang', '=', 'keranjang.id_barang')
                                ->orderBy('id_keranjang', 'desc')
                                ->get();
        $no = 0;
        $data = array();
        foreach ($keranjang as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->nama_barang;
            $row[] = $list->serial_number;
            $row[] = "Rp. ". format_uang($list->subtotal);
            $row[] = '<button type="button" class="btn btn-danger btn-sm" onclick="hapusKeranjang('.$list->id_keranjang.')"><i class="fa fa-trash"></i></button>';
            $data[] = $row;
        }
        $output = array("data" => $data);
        return response()->json($output);
    }

    public function totalKeranjang() {
        $keranjang = Keranjang::join('barang', 'barang.id_barang', '=', 'keranjang.id_barang')
                                ->where('keranjang.id_user', Auth()->user()->id)
                                ->orderBy('id_keranjang', 'desc')
                                ->get();
        $total = 0;
        foreach ($keranjang as $list) {
            $total += $list->subtotal;
        }
        echo json_encode($total);
    }

    public function dataBarang() {
        $barang = Barang::where('status', '1')->get();
        echo json_encode($barang);
    }

    public function hapusKeranjang($id) {
        $keranjang = Keranjang::find($id);
        $keranjang->delete();

        $barang = Barang::find($keranjang->id_barang);
        $barang->status = '1';
        $barang->update();
    }

    public function invoice() {
        $invoice = "INV/".date('Ymd')."/SEWA/".date('His');
        echo json_encode($invoice);
    }

    public function ongoing() {
        $status_sewa = StatusSewa::where('id_status_sewa', '2')->orWhere('id_status_sewa', '4')->get();
        $jaminan = Jaminan::all();
        return view ('penyewaan.ongoing', compact('status_sewa', 'jaminan'));
    }

    public function dataOngoing() {
        $penyewaan = Penyewaan::join('users', 'users.id', '=', 'penyewaan.id_penyewa')
                            ->join('status_sewa', 'status_sewa.id_status_sewa', '=', 'penyewaan.id_status_sewa')
                            ->select('penyewaan.*', 'users.name' ,'status_sewa.nama_status_sewa')
                            ->where('penyewaan.id_status_sewa', '=', 1)
                            ->orWhere('penyewaan.id_status_sewa', '=', 2)
                            ->get();
        $no = 0;
        $data = array();
        foreach ($penyewaan as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->no_invoice;
            $row[] = $list->tgl_sewa;
            $row[] = $list->tgl_kembali;
            $row[] = $list->id_status_sewa == '1' ? '<span class="badge badge-warning">'.$list->nama_status_sewa.'</span>' : '<span class="badge badge-success">'.$list->nama_status_sewa.'</span>';
            $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id_sewa.')"><i class="far fa-money-bill-alt"></i></a>';
            $row[] = '<a href="' . route('invoice.InvoiceSewa', $list->id_sewa) . '" class="btn btn-sm btn-success"><i class="fas fa-file-alt"></i></a>';
            $data[] = $row;
        }
        $output = array("data" => $data);
        return response()->json($output);
    }

    public function dataSewa($id) {
        $penyewaan = Penyewaan::join('users', 'users.id', '=', 'penyewaan.id_penyewa')
        ->join('status_sewa', 'status_sewa.id_status_sewa', '=', 'penyewaan.id_status_sewa')
        ->select('penyewaan.*', 'users.name' ,'status_sewa.nama_status_sewa')
        ->where('penyewaan.id_sewa', '=', $id)
        ->first();
        echo json_encode($penyewaan);
    }

    public function changeRiwayat(Request $request) {
        $penyewaan = Penyewaan::find($request->id);

        $riwayat = new RiwayatPenyewaan;
        $riwayat->id_penyewa = $penyewaan->id_penyewa;
        $riwayat->id_user = $penyewaan->id_user;
        $riwayat->no_invoice = $penyewaan->no_invoice;
        $riwayat->tgl_sewa = $penyewaan->tgl_sewa;
        $riwayat->tgl_kembali = $penyewaan->tgl_kembali;
        $riwayat->durasi = $penyewaan->durasi;
        $riwayat->total = $penyewaan->total;
        $riwayat->pajak = $penyewaan->pajak;
        $riwayat->dibayar = $penyewaan->dibayar;
        $riwayat->id_status_sewa = '3';
        $riwayat->id_jaminan = $penyewaan->id_jaminan;

        if($riwayat->save()) {
            $detail = DetailSewa::where('id_sewa', $penyewaan->id_sewa)->get();
            foreach ($detail as $list) {
                $detail_riwayat = new DetailRiwayatPenyewaan;
                $detail_riwayat->id_riwayat_penyewaan = $riwayat->id_riwayat_penyewaan;
                $detail_riwayat->id_barang = $list->id_barang;
                $detail_riwayat->subtotal = $list->subtotal;
                $detail_riwayat->save();

                $barang = Barang::find($list->id_barang);
                $barang->status = '1';
                $barang->update();
            }

            $detail = DetailSewa::where('id_sewa', $penyewaan->id_sewa)->delete();
            $penyewaan->delete();
        }
    }

    public function changeBerlangsung(Request $request) {
        $penyewaan = Penyewaan::find($request->id);

        $penyewaan->total = $request->total;
        $penyewaan->pajak = $request->pajak;
        $penyewaan->dibayar = $request->dibayar;
        $penyewaan->id_jaminan = $request->jaminan;
        $penyewaan->id_status_sewa = $request->status;
        $penyewaan->id_user = Auth()->user()->id;
        $penyewaan->update();
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
        $penyewaan = new Penyewaan;
        $penyewaan->id_penyewa = $request->penyewa;
        $penyewaan->id_user = Auth()->user()->id;
        $penyewaan->no_invoice = $request->noinv;
        $penyewaan->tgl_sewa = $request->tgl_sewa;
        $penyewaan->tgl_kembali = $request->tgl_kembali;
        $penyewaan->durasi = $request->durasi;
        $penyewaan->total = $request->total;
        $penyewaan->pajak = $request->pajak;
        $penyewaan->dibayar = $request->dibayar;
        $penyewaan->id_status_sewa = '2';
        $penyewaan->id_jaminan = $request->jaminan;

        if($penyewaan->save()) {
            $keranjang = Keranjang::join('barang', 'barang.id_barang', '=', 'keranjang.id_barang')
                                    ->where('keranjang.id_user', Auth()->user()->id)
                                    ->orderBy('id_keranjang', 'desc')
                                    ->get();
            foreach ($keranjang as $list) {
                $detail = new DetailSewa;
                $detail->id_sewa = $penyewaan->id_sewa;
                $detail->id_barang = $list->id_barang;
                $detail->subtotal = $list->subtotal;
                $detail->save();

                $keranjang = Keranjang::find($list->id_keranjang);
                $keranjang->delete();
            }
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
        $penyewaan = Penyewaan::find($id);
        echo json_encode($penyewaan);
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
