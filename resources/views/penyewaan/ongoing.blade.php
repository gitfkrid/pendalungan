@component('layouts.app')
    @slot('title')
        Penyewaan Ongoing- Pendalungan Megah Solusi
    @endslot

    @section('title')
        Penyewaan Ongoing
    @endsection

    @section('breadcrumb')
    @parent
        <li class="breadcrumb-item">Penyewaan ongoing</li>
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
                                    <th>Tanggal Sewa</th>
                                    <th>Tanggal Kembali</th>
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
        @include('penyewaan.form_riwayat')
        @include('penyewaan.form_paid')
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
                        "url" : "{{ route('penyewaan.dataOngoing') }}",
                        "type" : "GET"
                    }
                });
                $('#modal-riwayat form').on('submit', function(e){
                    var id = $('#id_riwayat').val();
                    if(!e.isDefaultPrevented()){
                        $.ajax({
                            url : "{{ url('penyewaan') }}" + '/ongoing/changeRiwayat',
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
                    var jaminan = $('#id_jaminan_paid').val();
                    var dibayar = $('#dibayar_paid').val();
                    var total = $('#total_paid').val();
                    var pajak = $('#pajak_paid').val();
                    var status = $('#id_status_paid').val();
                    if(!e.isDefaultPrevented()){
                        if(id == '' || jaminan == '' || dibayar == '' || total == '' || pajak == '' || status == '') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Data tidak boleh kosong!',
                            })
                        } else {
                            if (dibayar <= total) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Pembayaran kurang dari total!',
                                })
                            } else {
                                $.ajax({
                                    url : "{{ url('penyewaan') }}" + '/ongoing/changeBerlangsung',
                                    type : "POST",
                                    data : {
                                        id : id,
                                        jaminan : jaminan,
                                        dibayar : dibayar,
                                        pajak : pajak,
                                        total : total,
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
                $('#modal-riwayat form')[0].reset();
                $('#modal-paid form')[0].reset();
                $.ajax({
                    url : "{{ url('penyewaan') }}" + '/ongoing/' + id,
                    type : "GET",
                    dataType : "JSON",
                    success : function(data){
                        var status = data.id_status_sewa;

                        if(status == 1) {
                            $('#modal-paid').modal('show');
                            $('.modal-title').text('Selesaikan Penyewaan');

                            $('#id_paid').val(data.id_sewa);
                            $('#no_invoice_paid').val(data.no_invoice);
                            $('#name_paid').val(data.name);
                            $('#pajak_paid').val(data.pajak);
                            $('#total_paid').val(data.total);
                        } else if (status == 2) {
                            $('#modal-riwayat').modal('show');
                            $('.modal-title').text('Selesaikan Penyewaan');

                            $('#id_riwayat').val(data.id_sewa);
                            $('#no_invoice').val(data.no_invoice);
                            $('#name').val(data.name);
                            $('#nama_jaminan').val(data.id_jaminan);
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