@component('layouts.app')
    @slot('title')
        Data Pricelist Event - Pendalungan Megah Solusi
    @endslot

    @section('title')
        Pricelist Event
    @endsection

    @section('breadcrumb')
        @parent
        <li class="breadcrumb-item">Pricelist Event</li>
    @endsection

    @section('content')
        <div class="row">
            <div class="col-lg-12 mb-3">
                <a href="javascript:void(0)" class="btn btn-primary" onclick="addForm()"><i class="fa fa-plus-circle"></i> Tambah Pricelist</a>
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
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    @include('paket_event.form')
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
                        "url" : "{{ route('paket_event.data') }}",
                        "type" : "GET"
                    }
                });

                $('#modal-form form').on('submit', function(e){
                    if(!e.isDefaultPrevented()){
                        var id = $('#id').val();
                        if(save_method == "add") url = "{{ route('paket_event.store') }}";
                        else url = "paket_event/"+id;

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
                $('.modal-title').text('Tambah Pricelist Event');
            }

            function editForm(id){
                save_method = "edit";
                $('input[name=_method]').val('PATCH');
                $('#modal-form form')[0].reset();
                $.ajax({
                    url : "paket_event/"+id+"/edit",
                    type : "GET",
                    dataType : "JSON",
                    success : function(data){
                        $('#modal-form').modal('show');
                        $('.modal-title').text('Edit Pricelist Event');

                        $('#id').val(data.id_paket);
                        $('#kode_paket').val(data.kode_paket);
                        $('#nama_paket').val(data.nama_paket);
                        $('#harga_paket').val(data.harga_paket);
                    },
                    error : function(){
                        alert("Tidak dapat menampilkan data!");
                    }
                });
            }

            function deleteData(id) {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data paket event akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url : "paket_event/"+id,
                            type : "POST",
                            data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
                            success : function(data) {
                                Swal.fire(
                                    'Berhasil!',
                                    'Data paket event terhapus.',
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