@component('layouts.app')
    @slot('title')
        Penyewaan - Pendalungan Megah Solusi
    @endslot

    @section('title')
        Penyewaan
    @endsection

    @section('breadcrumb')
        @parent
        <li class="breadcrumb-item">Penyewaan</li>
    @endsection

    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                    <form method="POST" class="form form-horizontal" id="formBarang" data-toggle="validator" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row g-4">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="noinv">No Invoice</label>
                                    <input class="form-control" type="text" id="noinv" name="noinv" readonly>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group" id="tanggalsewa">
                                    <label for="tanggalsewa">Tanggal Penyewaan</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control" id="tglsewa" name="tanggalsewa" autofocus required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="waktusewa">Waktu Penyewaan</label>
                                    <div class="input-group clockpicker">
                                        <input type="text" id="waktusewa" name="waktusewa" class="form-control" required>                 
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        </div>                      
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="durasi">Durasi (Hari)</label>
                                    <input id="durasi" name="durasi" type="number" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="barang">Nama Barang</label>
                                    <select class="select2-single-placeholder form-control" name="state" id="barang">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="serial_number">Serial Number</label>
                                    <input type="text" class="form-control" id="serial_number" name="serial_number" readonly>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="subtotal">Harga Sewa</label>
                                    <input id="subtotal" name="subtotal" type="number" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-sm-1 align-self-center mt-3 text-right">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush" id="table">
                                <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Serial Number</th>
                                    <th>Harga Sewa</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="penyewa">Nama Penyewa</label>
                                    <select class="select2-single-placeholder form-control" name="state" id="penyewa" required>
                                        <option value="">Pilih Penyewa</option>
                                        @foreach ($penyewa as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="jaminan">Jaminan</label>
                                    <select class="form-control" id="jaminan" required>
                                        <option value="">Pilih Jaminan</option>
                                        @foreach ($jaminan as $data)
                                        <option value="{{ $data->id_jaminan }}">{{ $data->nama_jaminan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="hp_penyewa">No Hp</label>
                                    <input type="number" class="form-control" id="hp_penyewa" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="alamat_penyewa">Alamat</label>
                                    <input type="text" class="form-control" id="alamat_penyewa" readonly>
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
                            <a href="javascript:void(0)" class="btn btn-primary" onclick="formsewa()"><i class="fa fa-plus-circle"></i> Simpan</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    {{-- @include('barang.form') --}}
    @endsection

    @section('script')
        <script type="text/javascript">
            var table, barang, save_method;

            $(document).ready(function () {
                $('#barang').select2({
                    allowClear: true
                });
                $('#penyewa').select2({
                    allowClear: true
                });
                $('#tanggalsewa .input-group.date').datepicker({
                    format: 'yyyy-mm-dd',
                    todayBtn: 'linked',
                    todayHighlight: true,
                    autoclose: true,   
                });
                $('#waktusewa').clockpicker({
                    autoclose: true
                });
                $('#durasi').TouchSpin({
                    min: 0,
                    max: 7,                
                    boostat: 5,
                    maxboostedstep: 10,        
                    initval: 0
                });
                $.ajax({
                    url: "{{ route('penyewaan.dataBarang') }}",
                    type: "GET",
                    dataType: "JSON",
                    success: function(data){
                        $('#barang').empty();
                        $('#barang').append('<option value="">Pilih Barang</option>');
                        $.each(data, function(key, value){
                            $('#barang').append('<option value="'+ value.id_barang +'">'+ value.nama_barang +'</option>');
                        });
                    },
                    error: function(){
                        alert("Tidak ada data");
                    }
                });
                $.ajax({
                    url: "{{ route('penyewaan.invoice') }}",
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
                table = $('#table').DataTable({
                    "processing" : true,
                    'responsive' : true,
                    'scrollY'     : true,
                    'autoWidth'   : false,
                    "ajax" : {
                        "url" : "{{ route('penyewaan.dataKeranjang') }}",
                        "type" : "GET"
                    }
                });

                $('#formBarang').submit(function(e) {
                    e.preventDefault();
                    var barang = $('#barang').val();
                    var harga = $('#harga_sewa').val();
                    var durasi = $('#durasi').val();
                    var subtotal = $('#subtotal').val();
                    $.ajax({
                        url: "{{ route('penyewaan.chekout') }}",
                        type: "POST",
                        data: {
                            barang: barang,
                            subtotal: subtotal,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data){
                            $('#table').DataTable().ajax.reload();
                            $('#barang').val('');
                            barang = $.ajax({
                                url: "{{ route('penyewaan.dataBarang') }}",
                                type: "GET",
                                dataType: "JSON",
                                success: function(data){
                                    $('#barang').empty();
                                    $('#barang').append('<option value="">Pilih Barang</option>');
                                    $.each(data, function(key, value){
                                        $('#barang').append('<option value="'+ value.id_barang +'">'+ value.nama_barang +'</option>');
                                    });
                                },
                                error: function(){
                                    alert("Tidak ada data");
                                }
                            });
                            var durasi = $('#durasi').val();
                            $.ajax({
                                url: "{{ route('penyewaan.total') }}",
                                type: "GET",
                                dataType: "JSON",
                                success: function(data){
                                    $('#total').val(data*durasi);
                                    $('#pajak').val(0);
                                },
                                error: function(){
                                    alert("Tidak ada data");
                                }
                            });
                            $('#harga_sewa').val('');
                            $('#serial_number').val('');
                            $('#subtotal').val('');
                        },
                        error: function(){
                            alert("Gagal menambahkan data ke keranjang");
                        }
                    });
                    return false;
                });

                $('#barang').on('change', function(){
                    var id = $(this).val();
                    $.ajax({
                        url: "{{ url('penyewaan') }}/"+id+"/barang",
                        type: "GET",
                        dataType: "JSON",
                        success: function(data){
                            $('#subtotal').val(data.harga_sewa);
                            $('#serial_number').val(data.serial_number);
                        },
                        error: function(){
                            alert("Tidak ada data");
                            $('#subtotal').val('');
                            $('#serial_number').val('');
                        }
                    });
                })

                $('#penyewa').on('change', function(){
                    var id = $(this).val();
                    $.ajax({
                        url: "{{ url('penyewaan') }}/"+id+"/penyewa",
                        type: "GET",
                        dataType: "JSON",
                        success: function(data){
                            $('#hp_penyewa').val(data.hp);
                            $('#alamat_penyewa').val(data.alamat);
                        },
                        error: function(){
                            alert("Tidak ada data");
                            $('#hp_penyewa').val('');
                            $('#alamat_penyewa').val('');
                        }
                    });
                });
                $('#durasi').on('change', function(){
                    var durasi = $(this).val();
                    $.ajax({
                        url: "{{ route('penyewaan.total') }}",
                        type: "GET",
                        dataType: "JSON",
                        success: function(data){
                            $('#total').val(data*durasi);
                            $('#pajak').val(0);
                        },
                        error: function(){
                            alert("Tidak ada data");
                        }
                    });
                });
            });

            function formsewa() {
                var penyewa = $('#penyewa').val();
                var noinv = $('#noinv').val();
                var tanggalsewa = $('#tglsewa').val();
                var waktusewa = $('#waktusewa').val();
                var tgl_sewa;
                var tgl_kembali;
                var durasi = $('#durasi').val();
                var total = $('#total').val();
                var pajak = $('#pajak').val();
                var dibayar = $('#dibayar').val();
                var jaminan = $('#jaminan').val();

                tgl_sewa = tanggalsewa + ' ' + waktusewa + ':00';
                var hari = durasi*24*60*60*1000;
                var tglkembali = new Date(new Date(tgl_sewa).getTime() + hari);
                tgl_kembali = tglkembali.toISOString().slice(0, 10) + ' ' + waktusewa + ':00';

                if(penyewa == '' || noinv == '' || tanggalsewa == '' || waktusewa == '' || durasi == 0 || total == '' || pajak == '' || dibayar == '' || jaminan == ''){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Data tidak boleh kosong!',
                    })
                }else{
                    if (dibayar < total) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Pembayaran kurang dari total!',
                        })
                        return false;
                    } else {
                        $.ajax({
                            url : "{{ route('penyewaan.store') }}",
                            type : "POST",
                            data : {
                                penyewa: penyewa,
                                noinv: noinv,
                                tgl_sewa: tgl_sewa,
                                tgl_kembali: tgl_kembali,
                                durasi: durasi,
                                total: total,
                                pajak: pajak,
                                dibayar: dibayar,
                                jaminan: jaminan,
                                "_token": "{{ csrf_token() }}"
                            },
                            success : function(data) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: "Data Penyewaan Tersimpan!",
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

            function hapusKeranjang(id) {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data Keranjang akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('penyewaan') }}/"+id+"/hapusKeranjang",
                            type: "POST",
                            data: {
                                '_method': 'DELETE',
                                '_token': $('meta[name=csrf-token]').attr('content')
                            },
                            success : function(data) {
                                Swal.fire(
                                    'Berhasil!',
                                    'Data pelanggan terhapus.',
                                    'success'
                                )
                                barang = $.ajax({
                                    url: "{{ route('penyewaan.dataBarang') }}",
                                    type: "GET",
                                    dataType: "JSON",
                                    success: function(data){
                                        $('#barang').empty();
                                        $('#barang').append('<option value="">Pilih Barang</option>');
                                        $.each(data, function(key, value){
                                            $('#barang').append('<option value="'+ value.id_barang +'">'+ value.nama_barang +'</option>');
                                        });
                                    },
                                    error: function(){
                                        alert("Tidak ada data");
                                    }
                                });
                                $.ajax({
                                    url: "{{ route('penyewaan.total') }}",
                                    type: "GET",
                                    dataType: "JSON",
                                    success: function(data){
                                        $('#total').val(data);
                                        $('#pajak').val(0);
                                    },
                                    error: function(){
                                        alert("Tidak ada data");
                                    }
                                });
                                table.ajax.reload();
                            },
                            error : function () {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Tidak dapat menghapus data!',
                                })
                            }
                        });
                    }
                })
            }

        </script>
    @endsection
@endcomponent