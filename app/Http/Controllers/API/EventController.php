<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RiwayatEvent;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function riwayat(Request $request) {
        $validator = Validator::make($request->all(), [
            'id_status_event' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Cek kembali data yang anda masukkan',
                'data' => $validator->errors()
            ], 400);
        }

        $riwayat = RiwayatEvent::join('status_event', 'riwayat_event.id_status_event', '=', 'status_event.id_status_event')
            ->join('pelanggan', 'riwayat_event.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->join('paket_event', 'riwayat_event.id_paket', '=', 'paket_event.id_paket')
            ->select('paket_event.nama_paket', 'riwayat_event.no_invoice', 'riwayat_event.nama_event', 'riwayat_event.tanggal_mulai', 'riwayat_event.tanggal_selesai', 'riwayat_event.lokasi_event', 'pelanggan.nama_pelanggan', 'status_event.id_status_event', 'status_event.nama_status_event', 'riwayat_event.subtotal', 'riwayat_event.pajak', 'riwayat_event.total')
            ->where('riwayat_event.id_status_event', $request->id_status_event)
            ->get();

        if($riwayat) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan data riwayat',
                'data' => $riwayat
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan data riwayat',
                'data' => ''
            ], 500);
        }
    }

    public function detailRiwayat(Request $request) {
        $validator = Validator::make($request->all(), [
            'no_invoice' => 'required',
            'id_status_event' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Cek kembali data yang anda masukkan',
                'data' => $validator->errors()
            ], 400);
        }
        
        if($request->id_status_event == 1 || $request->id_status_event == 2) {
            $riwayat = Event::join('status_event', 'event.id_status_event', '=', 'status_event.id_status_event')
                ->join('pelanggan', 'event.id_pelanggan', '=', 'pelanggan.id_pelanggan')
                ->join('paket_event', 'event.id_paket', '=', 'paket_event.id_paket')
                ->select('paket_event.nama_paket', 'event.no_invoice', 'event.nama_event', 'event.tanggal_mulai', 'event.tanggal_selesai', 'event.lokasi_event', 'pelanggan.nama_pelanggan', 'status_event.id_status_event', 'status_event.nama_status_event', 'event.subtotal', 'event.pajak', 'event.total')
                ->where('event.no_invoice', $request->no_invoice)
                ->first();

            $data['nama_paket'] = $riwayat->nama_paket;
            $data['no_invoice'] = $riwayat->no_invoice;
            $data['nama_event'] = $riwayat->nama_event;
            $data['created_at'] = $riwayat->created_at;
            $data['tanggal_mulai'] = $riwayat->tanggal_mulai;
            $data['tanggal_selesai'] = $riwayat->tanggal_selesai;
            $data['lokasi_event'] = $riwayat->lokasi_event;
            $data['nama_pelanggan'] = $riwayat->nama_pelanggan;
            $data['id_status_event'] = $riwayat->id_status_event;
            $data['nama_status_event'] = $riwayat->nama_status_event;
            $data['subtotal'] =  "Rp. ". format_uang($riwayat->subtotal);
            $data['pajak'] = "Rp. ". format_uang($riwayat->pajak);
            $data['total'] = "Rp. ". format_uang($riwayat->total);

            if($riwayat) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil mendapatkan data riwayat',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mendapatkan data riwayat',
                    'data' => ''
                ], 500);
            }
        } else if($request->id_status_event == 3 || $request->id_status_event == 4) {
            $riwayat = RiwayatEvent::join('status_event', 'riwayat_event.id_status_event', '=', 'status_event.id_status_event')
                ->join('pelanggan', 'riwayat_event.id_pelanggan', '=', 'pelanggan.id_pelanggan')
                ->join('paket_event', 'riwayat_event.id_paket', '=', 'paket_event.id_paket')
                ->select('paket_event.nama_paket', 'riwayat_event.no_invoice', 'riwayat_event.nama_event', 'riwayat_event.tanggal_mulai', 'riwayat_event.tanggal_selesai', 'riwayat_event.lokasi_event', 'pelanggan.nama_pelanggan', 'status_event.id_status_event', 'status_event.nama_status_event', 'riwayat_event.subtotal', 'riwayat_event.pajak', 'riwayat_event.total')
                ->where('riwayat_event.no_invoice', $request->no_invoice)
                ->first();

            $data['nama_paket'] = $riwayat->nama_paket;
            $data['no_invoice'] = $riwayat->no_invoice;
            $data['nama_event'] = $riwayat->nama_event;
            $data['created_at'] = $riwayat->created_at;
            $data['tanggal_mulai'] = $riwayat->tanggal_mulai;
            $data['tanggal_selesai'] = $riwayat->tanggal_selesai;
            $data['lokasi_event'] = $riwayat->lokasi_event;
            $data['nama_pelanggan'] = $riwayat->nama_pelanggan;
            $data['id_status_event'] = $riwayat->id_status_event;
            $data['nama_status_event'] = $riwayat->nama_status_event;
            $data['subtotal'] =  "Rp. ". format_uang($riwayat->subtotal);
            $data['pajak'] = "Rp. ". format_uang($riwayat->pajak);
            $data['total'] = "Rp. ". format_uang($riwayat->total);
    
            if($riwayat) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil mendapatkan data riwayat',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mendapatkan data riwayat',
                    'data' => ''
                ], 500);
            }
        }
    }

    public function showEventHome(Request $request){
        $validator = Validator::make($request->all(), [
            'tanggal_mulai' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Cek kembali data yang anda masukkan',
                'data' => $validator->errors()
            ], 400);
        }

        $event = Event::join('status_event', 'event.id_status_event', '=', 'status_event.id_status_event')
            ->join('pelanggan', 'event.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->join('paket_event', 'event.id_paket', '=', 'paket_event.id_paket')
            ->select('paket_event.nama_paket', 'event.no_invoice', 'event.nama_event', 'event.tanggal_mulai', 'event.tanggal_selesai', 'event.lokasi_event', 'pelanggan.nama_pelanggan', 'status_event.nama_status_event','status_event.id_status_event', 'event.subtotal', 'event.pajak', 'event.total')                
            ->where( 'event.id_status_event', 2)
            ->where( 'event.tanggal_mulai', $request->tanggal_mulai)
            ->get();
        
        if($event) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan data event',
                'data' => $event
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan data event',
                'data' => ''
            ], 500);
        }
    }

    public function showEvent(Request $request) {
        $validator = Validator::make($request->all(), [
            'id_status_event' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Cek kembali data yang anda masukkan',
                'data' => $validator->errors()
            ], 400);
        }

        $event = Event::join('status_event', 'event.id_status_event', '=', 'status_event.id_status_event')
            ->join('pelanggan', 'event.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->join('paket_event', 'event.id_paket', '=', 'paket_event.id_paket')
            ->select('paket_event.nama_paket', 'event.no_invoice', 'event.nama_event', 'event.tanggal_mulai', 'event.tanggal_selesai', 'event.lokasi_event', 'pelanggan.nama_pelanggan', 'status_event.nama_status_event','status_event.id_status_event', 'event.subtotal', 'event.pajak', 'event.total')
            ->where('event.id_status_event', $request->id_status_event)
            ->get();
        
        if($event) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan data event',
                'data' => $event
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan data event',
                'data' => ''
            ], 500);
        }
    }
}
