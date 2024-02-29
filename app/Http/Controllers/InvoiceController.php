<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Penyewaan;
use App\Models\RiwayatEvent;
use App\Models\RiwayatPenyewaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class InvoiceController extends Controller
{
    public function indexEvent($id)
    {
        $data = RiwayatEvent::join('pelanggan', 'pelanggan.id_pelanggan', '=', 'riwayat_event.id_pelanggan')
            ->join('paket_event', 'paket_event.id_paket', '=', 'riwayat_event.id_paket')
            ->select('riwayat_event.*', 'pelanggan.nama_pelanggan', 'pelanggan.hp_pelanggan', 'pelanggan.alamat_pelanggan', 'pelanggan.email_pelanggan', 'paket_event.nama_paket', 'paket_event.harga_paket')
            ->where('riwayat_event.id_riwayat_event', $id)
            ->first();
        $data->tanggal = date('d M Y', strtotime($data->created_at));
        $data->duedate = date('d M Y', strtotime($data->tanggal_mulai));
        $data->harga = "Rp. " . format_uang($data->harga_paket);
        $data->subtotal = "Rp. " . format_uang($data->subtotal);
        $data->pajak = "Rp. " . format_uang($data->pajak);
        $data->total = "Rp. " . format_uang($data->total);
        return view('invoice.indexEvent', compact('data'));
    }

    public function downloadInvoiceEvent($id)
    {
        $data = RiwayatEvent::join('pelanggan', 'pelanggan.id_pelanggan', '=', 'riwayat_event.id_pelanggan')
            ->join('paket_event', 'paket_event.id_paket', '=', 'riwayat_event.id_paket')
            ->select('riwayat_event.*', 'pelanggan.nama_pelanggan', 'pelanggan.hp_pelanggan', 'pelanggan.alamat_pelanggan', 'pelanggan.email_pelanggan', 'paket_event.nama_paket', 'paket_event.harga_paket')
            ->where('riwayat_event.id_riwayat_event', $id)
            ->first();
        $data->tanggal = date('d M Y', strtotime($data->created_at));
        $data->duedate = date('d M Y', strtotime($data->tanggal_mulai));
        $data->harga = "Rp. " . format_uang($data->harga_paket);
        $data->subtotal = "Rp. " . format_uang($data->subtotal);
        $data->pajak = "Rp. " . format_uang($data->pajak);
        $data->total = "Rp. " . format_uang($data->total);

        $pdf = PDF::loadview('invoice.invoiceRiwayat', compact('data'))->setPaper('a4', 'portrait');
        $nama_file = 'INVOICE_' . $data->no_invoice . '.pdf';
        return $pdf->download($nama_file);
    }

    public function InvoiceEvent($id)
    {
        $data = Event::join('pelanggan', 'pelanggan.id_pelanggan', '=', 'event.id_pelanggan')
            ->join('paket_event', 'paket_event.id_paket', '=', 'event.id_paket')
            ->select('event.*', 'pelanggan.nama_pelanggan', 'pelanggan.hp_pelanggan', 'pelanggan.alamat_pelanggan', 'pelanggan.email_pelanggan', 'paket_event.nama_paket', 'paket_event.harga_paket')
            ->where('event.id_event', $id)
            ->first();
        $data->tanggal = date('d M Y', strtotime($data->created_at));
        $data->duedate = date('d M Y', strtotime($data->tanggal_mulai));
        $data->harga = "Rp. " . format_uang($data->harga_paket);
        $data->subtotal = "Rp. " . format_uang($data->subtotal);
        $data->pajak = "Rp. " . format_uang($data->pajak);
        $data->total = "Rp. " . format_uang($data->total);

        $pdf = PDF::loadview('invoice.indexEvent', compact('data'))->setPaper('a4', 'portrait');
        $nama_file = 'INVOICE_' . $data->no_invoice . '.pdf';
        return $pdf->download($nama_file);
    }

    public function indexSewa($id)
    {
        $riwayat = RiwayatPenyewaan::join('users', 'users.id', '=', 'riwayat_penyewaan.id_penyewa')
            ->join('status_sewa', 'status_sewa.id_status_sewa', '=', 'riwayat_penyewaan.id_status_sewa')
            ->join('jaminan', 'jaminan.id_jaminan', '=', 'riwayat_penyewaan.id_jaminan')
            ->select('riwayat_penyewaan.*', 'users.name', 'users.alamat', 'users.hp', 'status_sewa.nama_status_sewa', 'jaminan.nama_jaminan')
            ->where('riwayat_penyewaan.id_riwayat_penyewaan', $id)
            ->first();
        $riwayat->tanggal = date('d M Y', strtotime($riwayat->created_at));
        $riwayat->tanggal_sewa = $riwayat->tgl_sewa;
        $riwayat->tanggal_kembali = $riwayat->tgl_kembali;
        $riwayat->total = "Rp. " . format_uang($riwayat->total);
        $riwayat->dibayar = "Rp. " . format_uang($riwayat->dibayar);

        $detail_riwayat = RiwayatPenyewaan::join('detail_riwayat_penyewaan', 'detail_riwayat_penyewaan.id_riwayat_penyewaan', '=', 'riwayat_penyewaan.id_riwayat_penyewaan')
            ->join('barang', 'barang.id_barang', '=', 'detail_riwayat_penyewaan.id_barang')
            ->select('detail_riwayat_penyewaan.*', 'barang.nama_barang', 'barang.harga_sewa')
            ->where('riwayat_penyewaan.id_riwayat_penyewaan', $id)
            ->get();
        foreach ($detail_riwayat as $detail) {
            $detail->harga_sewa = "Rp. " . format_uang($detail->harga_sewa);
        }
        return view('invoice.indexSewa', compact('riwayat', 'detail_riwayat'));
    }

    public function downloadInvoiceSewa($id) {
        $riwayat = RiwayatPenyewaan::join('users', 'users.id', '=', 'riwayat_penyewaan.id_penyewa')
            ->join('status_sewa', 'status_sewa.id_status_sewa', '=', 'riwayat_penyewaan.id_status_sewa')
            ->join('jaminan', 'jaminan.id_jaminan', '=', 'riwayat_penyewaan.id_jaminan')
            ->select('riwayat_penyewaan.*', 'users.name', 'users.alamat', 'users.hp', 'status_sewa.nama_status_sewa', 'jaminan.nama_jaminan')
            ->where('riwayat_penyewaan.id_riwayat_penyewaan', $id)
            ->first();
        $riwayat->tanggal_sewa = $riwayat->tgl_sewa;
        $riwayat->tanggal_kembali = $riwayat->tgl_kembali;
        $riwayat->total = "Rp. " . format_uang($riwayat->total);
        $riwayat->dibayar = "Rp. " . format_uang($riwayat->dibayar);

        $detail_riwayat = RiwayatPenyewaan::join('detail_riwayat_penyewaan', 'detail_riwayat_penyewaan.id_riwayat_penyewaan', '=', 'riwayat_penyewaan.id_riwayat_penyewaan')
            ->join('barang', 'barang.id_barang', '=', 'detail_riwayat_penyewaan.id_barang')
            ->select('detail_riwayat_penyewaan.*', 'barang.nama_barang', 'barang.harga_sewa')
            ->where('riwayat_penyewaan.id_riwayat_penyewaan', $id)
            ->get();
        foreach ($detail_riwayat as $detail) {
            $detail->harga_sewa = "Rp. " . format_uang($detail->harga_sewa);
        }

        $pdf = PDF::loadview('invoice.indexSewa', compact('riwayat', 'detail_riwayat'))->setPaper('a4', 'portrait');
        $nama_file = 'INVOICE_' . $riwayat->no_invoice . '.pdf';
        return $pdf->download($nama_file);
    }

    public function invoiceSewa($id) {
        $riwayat = Penyewaan::join('users', 'users.id', '=', 'penyewaan.id_penyewa')
            ->join('status_sewa', 'status_sewa.id_status_sewa', '=', 'penyewaan.id_status_sewa')
            ->join('jaminan', 'jaminan.id_jaminan', '=', 'penyewaan.id_jaminan')
            ->select('penyewaan.*', 'users.name', 'users.alamat', 'users.hp', 'status_sewa.nama_status_sewa', 'jaminan.nama_jaminan')
            ->where('penyewaan.id_sewa', $id)
            ->first();
        $riwayat->tanggal_sewa = $riwayat->tgl_sewa;
        $riwayat->tanggal_kembali = $riwayat->tgl_kembali;
        $riwayat->total = "Rp. " . format_uang($riwayat->total);
        $riwayat->dibayar = "Rp. " . format_uang($riwayat->dibayar);

        $detail_riwayat = Penyewaan::join('detail_sewa', 'detail_sewa.id_sewa', '=', 'penyewaan.id_sewa')
            ->join('barang', 'barang.id_barang', '=', 'detail_sewa.id_barang')
            ->select('detail_sewa.*', 'barang.nama_barang', 'barang.harga_sewa')
            ->where('penyewaan.id_sewa', $id)
            ->get();
        foreach ($detail_riwayat as $detail) {
            $detail->harga_sewa = "Rp. " . format_uang($detail->harga_sewa);
        }
        
        $pdf = PDF::loadview('invoice.indexSewa', compact('riwayat', 'detail_riwayat'))->setPaper('a4', 'portrait');
        $nama_file = 'INVOICE_' . $riwayat->no_invoice . '.pdf';
        return $pdf->download($nama_file);
    }
}
