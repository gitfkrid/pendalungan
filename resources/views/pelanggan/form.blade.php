<div class="modal fade" id="modal-form" tabindex="-1" aria-hidden="true">
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
                    <input type="hidden" id="id" name="id"/>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                            <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control" autofocus required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="alamat_pelanggan" class="form-label">Alamat</label>
                            <input type="text" id="alamat_pelanggan" name="alamat_pelanggan" class="form-control" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="email_pelanggan" class="form-label">Email</label>
                            <input type="email" id="email_pelanggan" name="email_pelanggan" class="form-control" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="hp_pelanggan" class="form-label">No Hp</label>
                            <input type="text" id="hp_pelanggan" name="hp_pelanggan" class="form-control" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>