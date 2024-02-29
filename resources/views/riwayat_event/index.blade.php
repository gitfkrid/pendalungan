@component('layouts.app')
    @slot('title')
        Riwayat Event - Pendalungan Megah Solusi
    @endslot

    @section('title')
        Riwayat Event
    @endsection

    @section('breadcrumb')
    @parent
        <li class="breadcrumb-item">Riwayat Event</li>
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
                        <th>Nama Event</th>
                        <th>Client</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Lokasi</th>
                        <th>Invoice</th>
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
                        "url" : "{{ route('riwayat_event.data') }}",
                        "type" : "GET"
                    }
                });
            });
        </script>
    @endsection
@endcomponent