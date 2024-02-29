@component('layouts.app')
    @slot('title')
        Event Ongoing- Pendalungan Megah Solusi
    @endslot

    @section('title')
        Event Ongoing
    @endsection

    @section('breadcrumb')
    @parent
        <li class="breadcrumb-item">Event ongoing</li>
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
                                <th>Tanggal Event</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('event.form_paid')
    @include('event.form_riwayat')
    @endsection

    @section('script')
        <script type="text/javascript">
            var table, save_method;
            var dibayarlama = 0;

            $(function(){
                table = $('#table').DataTable({
                    "processing" : true,
                    'responsive' : true,
                    'scrollY'     : true,
                    'autoWidth'   : false,
                    "ajax" : {
                        "url" : "{{ route('event.dataOngoing') }}",
                        "type" : "GET"
                    }
                });
                $('#modal-riwayat form').on('submit', function(e){
                    var id = $('#id_riwayat').val();
                    if(!e.isDefaultPrevented()){
                        $.ajax({
                            url : "{{ url('event') }}" + '/ongoing/changeRiwayat',
                            type : "POST",
                            data : {
                                id : id,
                                "_token" : "{{ csrf_token() }}"
                            },
                            success : function(data){
                                $('#modal-riwayat').modal('hide');
                                table.ajax.reload();
                            },
                            error : function(){
                                alert("Tidak dapat menyimpan data!");
                            }
                        });
                        return false;
                    }
                });
                $('#modal-paid form').on('submit', function(e){
                    var id = $('#id_paid').val();
                    var dibayar = $('#dibayar_paid').val();
                    var dibayarbaru = parseInt(dibayar) + parseInt(dibayarlama);
                    var kurang = $('#kurang_paid').val();
                    var status = $('#id_status_paid').val();
                    if(!e.isDefaultPrevented()){
                        if(dibayar == "" || status == "") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Data tidak boleh kosong!',
                            })
                        } else {
                            if (dibayar < kurang) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Pembayaran kurang!',
                                })
                            } else {
                                $.ajax({
                                    url : "{{ url('event') }}" + '/ongoing/changeBerlangsung',
                                    type : "POST",
                                    data : {
                                        id : id,
                                        dibayar : dibayarbaru,
                                        status : status,
                                        "_token" : "{{ csrf_token() }}",
                                        "_method" : "PATCH"
                                    },
                                    success : function(data){
                                        $('#modal-paid').modal('hide');
                                        table.ajax.reload();
                                    },
                                    error : function(){
                                        alert("Tidak dapat menyimpan data!");
                                    }
                                });
                            }
                        }
                        return false;
                    }
                });
            });

            function editForm(id){
                $('input[name=_method]').val('PATCH');
                $('#modal-paid form')[0].reset();
                $('#modal-riwayat form')[0].reset();
                $.ajax({
                    url : "{{ url('event') }}" + '/ongoing/' + id,
                    type : "GET",
                    dataType : "JSON",
                    success : function(data){
                        var status = data.id_status_event;
                        var total = data.total;
                        var dibayar = data.dibayar;
                        dibayarlama = dibayar;
                        var kurang = total - dibayar;
                        var setStatus = '2';

                        if(status == 1) {
                            $('#modal-paid').modal('show');
                            $('.modal-title').text('Selesaikan Event');

                            $('#id_paid').val(data.id_event);
                            $('#no_invoice_paid').val(data.no_invoice);
                            $('#subtotal_paid').val(data.subtotal);
                            $('#pajak_paid').val(data.pajak);
                            $('#total_paid').val(data.total);
                            $('#kurang_paid').val(kurang);
                            $('#id_status_paid').val(setStatus);
                        } else if (status == 2) {
                            $('#modal-riwayat').modal('show');
                            $('.modal-title').text('Selesaikan Event');

                            $('#id_riwayat').val(data.id_event);
                            $('#no_invoice').val(data.no_invoice);
                        }
                    },
                    error : function(){
                        alert("Tidak dapat menampilkan data!");
                    }
                });
            }

        </script>
    @endsection
@endcomponent