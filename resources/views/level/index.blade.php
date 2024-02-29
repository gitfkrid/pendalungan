@component('layouts.app')
    @slot('title')
        Data Level - Pendalungan Megah Solusi
    @endslot

    @section('title')
        Level
    @endsection

    @section('breadcrumb')
        @parent
        <li class="breadcrumb-item">Level</li>
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
                            <th>Nama Level</th>
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
            var table, save_method;

            $(function(){
                table = $('#table').DataTable({
                    "processing" : true,
                    'responsive' : true,
                    'scrollY'     : true,
                    'autoWidth'   : false,
                    "ajax" : {
                        "url" : "{{ route('level.data') }}",
                        "type" : "GET"
                    }
                });
            });

        </script>
    @endsection
@endcomponent