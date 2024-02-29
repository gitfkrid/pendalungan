@component('layouts.app')
    @slot('title')
        Riwayat Penyewaan - Pendalungan Megah Solusi
    @endslot

    @section('title')
        Riwayat Penyewaan
    @endsection

    @section('breadcrumb')
    @parent
        <li class="breadcrumb-item">Riwayat Penyewaan</li>
    @endsection

    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="table">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>No Invoice</th>
                            <th>Penyewa</th>
                            <th>Tanggal Sewa</th>
                            <th>Tanggal Kembali</th>
                            <th>Jaminan</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script type="text/javascript">
            $(function(){
                table = $('#table').DataTable({
                    "processing" : true,
                    'responsive' : true,
                    'scrollY'     : true,
                    'autoWidth'   : false,
                    "ajax" : {
                        "url" : "{{ route('riwayat_penyewaan.data') }}",
                        "type" : "GET"
                    }
                });
            });
        </script>
    @endsection
@endcomponent