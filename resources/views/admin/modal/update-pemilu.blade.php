@foreach ($pemilu as $p)
    <div class="modal fade" tabindex="-1" role="dialog" id="modalUpdateData{{ $p->id }}">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="createRecord" action="{{ url('admin/pemilu/' . $p->id . '/update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Update Pemilu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Pemilu</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $p->name }}">
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Start Date</label>
                            <input type="datetime-local" class="form-control" name="start_date"
                                value="{{ $p->start_date }}">
                            @if ($errors->has('start_date'))
                                <span class="help-block">{{ $errors->first('start_date') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">End Date</label>
                            <input type="datetime-local" class="form-control" name="end_date"
                                value="{{ $p->end_date }}">
                            @if ($errors->has('end_date'))
                                <span class="help-block">{{ $errors->first('end_date') }}</span>
                            @endif
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
