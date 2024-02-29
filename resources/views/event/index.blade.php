@component('layouts.app')
    @slot('title')
        Event - Pendalungan Megah Solusi
    @endslot

    @section('title')
        Event
    @endsection

    @section('breadcrumb')
    @parent
        <li class="breadcrumb-item">Event</li>
    @endsection

    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                    <form method="POST" class="form form-horizontal" id="formBarang" data-toggle="validator" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row g-3">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="noinv">No Invoice</label>
                                    <input class="form-control" type="text" id="noinv" name="noinv" readonly>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group" id="tanggalmulai">
                                    <label for="tanggalmulai">Tanggal Mulai</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="tglmulai" name="tanggalmulai" required autofocus>
                                        </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group" id="tanggalselesai">
                                    <label for="tanggalselesai">Tanggal Selesai</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control" id="tglselesai" name="tanggalselesai" required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-sm mb-3">
                                <label for="nama_event">Nama Event</label>
                                <input type="text" class="form-control" id="nama_event" name="nama_event" required>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="lokasi_event">Lokasi Event</label>
                                    <input type="text" class="form-control" id="lokasi_event" name="lokasi_event" required>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="pelanggan">Nama Pelanggan</label>
                                    <select class="select2-single-placeholder form-control" name="state" id="pelanggan" required>
                                        <option value="">Pilih Pelanggan</option>
                                        @foreach ($pelanggan as $data)
                                            <option value="{{ $data->id_pelanggan }}">{{ $data->nama_pelanggan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="jaminan">Paket Event</label>
                                    <select class="form-control" id="paket_event" required>
                                        <option value="">Pilih Paket</option>
                                        @foreach ($paket_event as $data)
                                        <option value="{{ $data->id_paket }}">{{ $data->nama_paket }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="qty">QTY</label>
                                    <input id="qty" name="qty" type="number" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="harga_paket">Harga Paket</label>
                                    <input type="text" class="form-control" id="harga_paket" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="hp_pelanggan">No Hp</label>
                                    <input type="number" class="form-control" id="hp_pelanggan" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="alamat_pelanggan">Alamat</label>
                                    <input type="text" class="form-control" id="alamat_pelanggan" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="subtotal">Subtotal</label>
                                <input type="number" class="form-control" id="subtotal" readonly>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="pajak">Pajak</label>
                                <input type="number" class="form-control" id="pajak" readonly>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="number" class="form-control" id="total" readonly>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="dibayar">Dibayar</label>
                                <input type="number" class="form-control" id="dibayar" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3 text-right">
                            <a href="javascript:void(0)" class="btn btn-primary" onclick="formevent()"><i class="fa fa-plus-circle"></i> Simpan</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection

    @section('script')
        <script type="text/javascript">
            $(document).ready(function () {
                $('#pelanggan').select2({
                    allowClear: true
                });
                $('#tanggalmulai .input-group.date').datepicker({
                    format: 'yyyy-mm-dd',
                    todayBtn: 'linked',
                    todayHighlight: true,
                    autoclose: true,   
                });
                $('#tanggalselesai .input-group.date').datepicker({
                    format: 'yyyy-mm-dd',
                    todayBtn: 'linked',
                    todayHighlight: true,
                    autoclose: true,   
                });
                $('#qty').TouchSpin({
                    min: 0,
                    max: 7,                
                    boostat: 5,
                    maxboostedstep: 10,        
                    initval: 0
                });
                $.ajax({
                    url: "{{ route('event.invoice') }}",
                    type: "GET",
                    dataType: "JSON",
                    success: function(data){
                        $('#noinv').val(data);
                    },
                    error: function(){
                        alert("Tidak ada data");
                    }
                });
            });

            $(function() {
                var harga;
                $('#pelanggan').on('change', function(){
                    var id = $(this).val();
                    $.ajax({
                        url: "{{ url('event') }}/"+id+"/pelanggan",
                        type: "GET",
                        dataType: "JSON",
                        success: function(data){
                            $('#hp_pelanggan').val(data.hp_pelanggan);
                            $('#alamat_pelanggan').val(data.alamat_pelanggan);
                        },
                        error: function(){
                            alert("Tidak ada data");
                            $('#hp_pelanggan').val('');
                            $('#alamat_pelanggan').val('');
                        }
                    });
                });
                $('#paket_event').on('change', function(){
                    var id = $(this).val();
                    $.ajax({
                        url: "{{ url('event') }}/"+id+"/paket_event",
                        type: "GET",
                        dataType: "JSON",
                        success: function(data){
                            $('#harga_paket').val(data.harga_paket_rp);

                            harga = (data.harga_paket);
                        },
                        error: function(){
                            alert("Tidak ada data");
                            $('#harga_paket').val('');
                        }
                    });
                });
                $('#qty').on('change', function(){
                    var subtotal = parseInt(harga) * parseInt($('#qty').val());
                    var pajak = subtotal * 14 / 100;
                    var total = parseInt(subtotal) + parseInt(pajak);
                    
                    $('#subtotal').val(subtotal);
                    $('#pajak').val(pajak);
                    $('#total').val(total);
                });
            });

            function formevent() {
                var id_paket = $('#paket_event').val();
                var no_invoice = $('#noinv').val();
                var nama_event = $('#nama_event').val();
                var tanggal_mulai = $('#tglmulai').val();
                var tanggal_selesai = $('#tglselesai').val();
                var lokasi_event = $('#lokasi_event').val();
                var id_pelanggan = $('#pelanggan').val();
                var qty = $('#qty').val();
                var subtotal = $('#subtotal').val();
                var pajak = $('#pajak').val();
                var total = $('#total').val();
                var dibayar = $('#dibayar').val();

                if(id_paket == '' || no_invoice == '' || nama_event == '' || tanggal_mulai == '' || tanggal_selesai == '' || lokasi_event == '' || id_pelanggan == '' || qty == 0 || subtotal == '' || pajak == '' || total == '' || dibayar == ''){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Data tidak boleh kosong!',
                    })
                } else {
                    if(dibayar < (total * 30 / 100)){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Pembayaran minimal 30%',
                        })
                    } else if (dibayar >= total) {
                        $.ajax({
                            url : "{{ route('event.berlangsung') }}",
                            type : "POST",
                            data : {
                                "id_paket" : id_paket,
                                "no_invoice" : no_invoice,
                                "nama_event" : nama_event,
                                "tanggal_mulai" : tanggal_mulai,
                                "tanggal_selesai" : tanggal_selesai,
                                "lokasi_event" : lokasi_event,
                                "id_pelanggan" : id_pelanggan,
                                "qty" : qty,
                                "subtotal" : subtotal,
                                "pajak" : pajak,
                                "total" : total,
                                "dibayar" : dibayar,
                                "_token": "{{ csrf_token() }}"
                            },
                            success : function(data) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: "Data Event Tersimpan!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'OK'
                                    }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            },
                            error : function () {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Tidak dapat menyimpan data!',
                                })
                            }
                        });
                    } else {
                        $.ajax({
                            url : "{{ route('event.store') }}",
                            type : "POST",
                            data : {
                                "id_paket" : id_paket,
                                "no_invoice" : no_invoice,
                                "nama_event" : nama_event,
                                "tanggal_mulai" : tanggal_mulai,
                                "tanggal_selesai" : tanggal_selesai,
                                "lokasi_event" : lokasi_event,
                                "id_pelanggan" : id_pelanggan,
                                "qty" : qty,
                                "subtotal" : subtotal,
                                "pajak" : pajak,
                                "total" : total,
                                "dibayar" : dibayar,
                                "_token": "{{ csrf_token() }}"
                            },
                            success : function(data) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: "Data Event Tersimpan!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'OK'
                                    }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            },
                            error : function () {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Tidak dapat menyimpan data!',
                                })
                            }
                        });
                    }
                }
            }

        </script>
    @endsection
@endcomponent