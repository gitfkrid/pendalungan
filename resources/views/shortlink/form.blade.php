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
                            <label for="kode" class="form-label">Kode (kosongi jika ingin random)</label>
                            <input type="text" id="kode" name="kode" class="form-control" autofocus />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="link" class="form-label">Link</label>
                            <input type="text" id="link" name="link" class="form-control" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" class="form-control" required></textarea>
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