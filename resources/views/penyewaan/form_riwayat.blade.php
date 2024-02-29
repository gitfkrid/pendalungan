<div class="modal fade" id="modal-riwayat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" class="form-horizontal" data-toggle="validator">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_riwayat" name="id_riwayat"/>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="no_invoice" class="form-label">No Invoice</label>
                            <input type="text" id="no_invoice" name="no_invoice" class="form-control" required readonly/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Nama Penyewa</label>
                            <input type="text" id="name" name="name" class="form-control" required readonly/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="jaminan">Jaminan</label>
                                <select class="form-control" id="nama_jaminan" readonly required>
                                    <option value="">Pilih Jaminan</option>
                                    @foreach ($jaminan as $data)
                                    <option value="{{ $data->id_jaminan }}">{{ $data->nama_jaminan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Selesai</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>