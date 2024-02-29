@component('layouts.app')
    @slot('title')
    Data Penyewa - Pendalungan Megah Solusi
    @endslot

    @section('title')
    Penyewa
    @endsection

    @section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Penyewa</li>
    @endsection

    @section('content')
    <div class="row">
        <div class="col-lg-12 mb-3">
            <a href="javascript:void(0)" class="btn btn-primary" onclick="addForm()"><i class="fa fa-plus-circle"></i> Tambah Data</a>
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
                        <th>Nama Penyewa</th>
                        <th>Email Penyewa</th>
                        <th>Hp Penyewa</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    @include('penyewa.form')
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
                        "url" : "{{ route('penyewa.data') }}",
                        "type" : "GET"
                    }
                });

                $('#modal-form form').on('submit', function(e){
                    if(!e.isDefaultPrevented()){
                        $.ajax({
                            url : "{{ route('penyewa.store') }}",
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
                $('.modal-title').text('Tambah Penyewa');
            }

            function deleteData(id) {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data Penyewa akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url : "penyewa/"+id,
                            type : "POST",
                            data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
                            success : function(data) {
                                Swal.fire(
                                    'Berhasil!',
                                    'Data Penyewa terhapus.',
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