@foreach ($osis as $o)
<div class="modal fade" tabindex="-1" role="dialog" id="modalUpdateData{{ $o->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="createRecord" action="{{ url('admin/calon/'.$o->id.'/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Update Calon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Calon Ketua OSIS</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $o->name }}">
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Kelas</label>
                        <input type="text" class="form-control" id="name" name="kelas" value="{{ $o->kelas }}">
                    </div>
                    <div class="form-group">
                        <label>Pilih Pemilu</label>
                        <select class="form-control select2" name="pemilu_id">
                            @foreach ($pemilu as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Visi</label>
                        <input type="text" class="form-control" id="name" name="visi" value="{{ $o->visi }}">
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Misi</label>
                        <input type="text" class="form-control" id="name" name="misi" value="{{ $o->misi }}">
                    </div>
                    <div class="form-group">
                        <label>Upload Foto</label>
                        <input type="file" class="form-control" name="photo">
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