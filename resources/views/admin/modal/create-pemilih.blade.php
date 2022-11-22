<div class="modal fade" tabindex="-1" role="dialog" id="modalCreateData">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="createRecord" action="{{ url('admin/'.$pemiluID.'/pemilih') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create Pemilih</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="form-label">Jumlah Pemilih</label>
                        <input type="number" min="0" class="form-control" id="name" name="jumlah">
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleFormControlSelect1">Pilih Dapil</label>
                        <select class="form-control" name="dapil" id="exampleFormControlSelect1">
                            @foreach ($data->dapil as $dapil)
                                <option value="{{$dapil->id}}">{{$dapil->name}}</option>
                            @endforeach
                        </select>
                      </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
