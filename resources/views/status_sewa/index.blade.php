@component('layouts.app')
    @slot('title')
        Status Penyewaan - Pendalungan Megah Solusi
    @endslot

    @section('title')
        Status Penyewaan
    @endsection

    @section('breadcrumb')
        @parent
        <li class="breadcrumb-item">Status Penyewaan</li>
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
                            <th>Nama Status</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    @include('status_sewa.form')
    @endsection

    @section('script')
        <script type="text/javascript">
            var table, save_method;

            $(function(){
                table = $('#table').DataTable({
                    "processing" : true,
                    'scrollY'     : true,
                    'autoWidth'   : false,
                    "ajax" : {
                        "url" : "{{ route('status_sewa.data') }}",
                        "type" : "GET"
                    }
                });
            });

        </script>
    @endsection
@endcomponent