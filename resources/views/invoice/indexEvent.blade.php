<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Invoice - Pendalungan Megah Solusi</title>
    <link rel="stylesheet" href="{{ asset('public/assets/invoice/style.css') }}" media="all" />
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="{{ asset('public/assets/img/logo/logo_black.png') }}" />
        </div>
        <h3>INVOICE: {{ $data->no_invoice }}</h3>
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
            <div><span>CLIENT</span> {{ $data->nama_pelanggan }}</div>
            <div>
                <span>ADDRESS</span> {{ $data->alamat_pelanggan }}
            </div>
            <div>
                <span>EMAIL</span>
                <a href="mailto:{{ $data->email_pelanggan }}">{{ $data->email_pelanggan }}</a>
            </div>
            <div><span>DATE</span> {{ $data->tanggal }}</div>
            <div><span>DUE DATE</span> {{ $data->duedate }}</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="desc"><b>DESKRIPSI</b></th>
                    <th><b>HARGA</b></th>
                    <th><b>QTY</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="desc">
                        {{ $data->nama_paket }}
                    </td>
                    <td class="unit">{{ $data->harga }}</td>
                    <td class="qty">{{ $data->qty }}</td>
                </tr>
                <tr>
                    <td colspan="2">SUBTOTAL</td>
                    <td class="total">{{ $data->subtotal }}</td>
                </tr>
                <tr>
                    <td colspan="2">PAJAK (14%)</td>
                    <td class="total">{{ $data->pajak }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="grand total"><b>GRAND TOTAL</b></td>
                    <td class="grand total"><b>{{ $data->total }}</b></td>
                </tr>
            </tbody>
        </table>
        <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">
                Silakan melakukan pelunasan sesuai dengan tenggat waktu yang telah ditentukan.
            </div>
        </div>
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and
        seal.
    </footer>
</body>

</html>
