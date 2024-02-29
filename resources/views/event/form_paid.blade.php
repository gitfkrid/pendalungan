<div class="modal fade" id="modal-paid" tabindex="-1" aria-hidden="true">
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
                    <input type="hidden" id="id_paid" name="id_paid"/>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="no_invoice_paid" class="form-label">No Invoice</label>
                            <input type="text" id="no_invoice_paid" name="no_invoice_paid" class="form-control" required readonly/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="subtotal_paid" class="form-label">Subtotal</label>
                            <input type="number" id="subtotal_paid" name="subtotal_paid" class="form-control" required readonly/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="pajak_paid" class="form-label">Pajak</label>
                            <input type="number" id="pajak_paid" name="pajak_paid" class="form-control" required readonly/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="total_paid" class="form-label">Total</label>
                            <input type="number" id="total_paid" name="total_paid" class="form-control" required readonly/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="kurang_paid" class="form-label">Kurang</label>
                            <input type="number" id="kurang_paid" name="kurang_paid" class="form-control" required readonly/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="dibayar_paid" class="form-label">Dibayar</label>
                            <input type="text" id="dibayar_paid" name="dibayar_paid" class="form-control" required autofocus/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="id_status_paid" required>
                                    <option value="">Pilih Status</option>
                                    @foreach ($status_event as $data)
                                    <option value="{{ $data->id_status_event }}">{{ $data->nama_status_event }}</option>
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