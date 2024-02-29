<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Invoice - Pendalungan Megah Solusi</title>
    <link rel="stylesheet" href="{{ asset('public/assets/invoice/style_sewa.css') }}" media="all" />
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="{{ asset('public/assets/img/logo/logo_black.png') }}" />
        </div>
        <h3>INVOICE: {{ $riwayat->no_invoice }}</h3>
        <div id="company" class="clearfix">
            <div>Pendalungan Megah Solusi</div>
            <div>
                Jl. Semeru Raya 22,<br />
                Jember, 68121
            </div>
            <div>082323581176</div>
            <div>
                <a href="mailto:cvpendalunganmegahsolusi@gmail.com">cvpendalunganmegahsolusi@gmail.com</a>
            </div>
        </div>
        <div id="project">
            <div><span>CLIENT</span> {{ $riwayat->name }}</div>
            <div>
                <span>ADDRESS</span> {{ $riwayat->alamat }}
            </div>
            <div><span>NO HP</span> {{ $riwayat->hp }}</div>
            <div><span>SEWA</span> {{ $riwayat->tanggal_sewa }}</div>
            <div><span>KEMBALI</span> {{ $riwayat->tanggal_kembali }}</div>
            <div><span>JAMINAN</span> {{ $riwayat->nama_jaminan }}</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="desc"><b>DESKRIPSI</b></th>
                    <th><b>HARGA</b></th>
                    <th><b>DURASI</b></th>
                </tr>
            </thead>
            <tbody></tbody>
            @foreach ($detail_riwayat as $item)
                <tr>
                    <td class="desc">{{ $item->nama_barang }}</td>
                    <td class="unit">{{ $item->harga_sewa }}</td>
                    <td class="qty">{{ $riwayat->durasi }} Hari</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2">SUBTOTAL</td>
                <td class="total">{{ $riwayat->total }}</td>
            </tr>
            <tr>
                <td colspan="2">PAJAK</td>
                <td class="total">{{ $riwayat->pajak }}</td>
            </tr>
            <tr>
                <td colspan="2" class="grand total"><b>GRAND TOTAL</b></td>
                <td class="grand total"><b>{{ $riwayat->total }}</b></td>
            </tr>
            </tbody>
        </table>
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and
        seal.
    </footer>
</body>

</html>
