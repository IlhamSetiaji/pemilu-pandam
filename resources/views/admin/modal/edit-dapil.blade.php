@foreach ($data as $p)
<div class="modal fade" tabindex="-1" role="dialog" id="editDapil{{$p->id}}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="createRecord" action="{{url('admin/dapil/'.Crypt::encrypt($p->id).'/update')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Dapil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Dapil</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$p->name}}" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleFormControlSelect1">Pilih Pemilu</label>
                        <select class="form-control" name="pemilu_id" id="exampleFormControlSelect1">
                            @foreach ($pemilu as $data)
                                <option value="{{$data->id}}" @if ($data->id == $p->pemilu_id)
                                    selected
                                @endif>{{$data->name}}</option>
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

@endforeach
