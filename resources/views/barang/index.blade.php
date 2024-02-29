@component('layouts.app')
    @slot('title')
        Data Barang - Pendalungan Megah Solusi
    @endslot

    @section('title')
        Barang
    @endsection

    @section('breadcrumb')
        @parent
        <li class="breadcrumb-item">Barang</li>
    @endsection

    @section('content')
        <div class="row">
            <div class="col-lg-12 mb-3">
                <a href="javascript:void(0)" class="btn btn-primary" onclick="addForm()"><i class="fa fa-plus-circle"></i> Tambah Barang</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="table">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Serial Number</th>
                            <th>Harga Sewa</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    @include('barang.form')
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
                        "url" : "{{ route('barang.data') }}",
                        "type" : "GET"
                    }
                });

                $('#modal-form form').on('submit', function(e){
                    if(!e.isDefaultPrevented()){
                        var id = $('#id').val();
                        if(save_method == "add") url = "{{ route('barang.store') }}";
                        else url = "barang/"+id;

                        $.ajax({
                            url : url,
                            type : "POST",
                            data : $('#modal-form form').serialize(),
                            success : function(data){
                                $('#modal-form').modal('hide');
                                table.ajax.reload();
                            },
                            error : function(){
                                alert("Tidak dapat menyimpan data!");
                            }
                        });
                        return false;
                    }
                });
            });

            function addForm(){
                save_method = "add";
                $('input[name=_method]').val('POST');
                $('#modal-form').modal('show');
                $('#modal-form form')[0].reset();
                $('.modal-title').text('Tambah Barang');
            }

            function editForm(id){
                save_method = "edit";
                $('input[name=_method]').val('PATCH');
                $('#modal-form form')[0].reset();
                $.ajax({
                    url : "barang/"+id+"/edit",
                    type : "GET",
                    dataType : "JSON",
                    success : function(data){
                        $('#modal-form').modal('show');
                        $('.modal-title').text('Edit Barang');

                        $('#id').val(data.id_barang);
                        $('#kode_barang').val(data.kode_barang);
                        $('#nama_barang').val(data.nama_barang);
                        $('#id_kategori').val(data.id_kategori);
                        $('#serial_number').val(data.serial_number);
                        $('#harga_sewa').val(data.harga_sewa);
                    },
                    error : function(){
                        alert("Tidak dapat menampilkan data!");
                    }
                });
            }

            function deleteData(id) {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data Barang akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url : "barang/"+id,
                            type : "POST",
                            data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
                            success : function(data) {
                                Swal.fire(
                                    'Berhasil!',
                                    'Data barang terhapus.',
                                    'success'
                                )
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