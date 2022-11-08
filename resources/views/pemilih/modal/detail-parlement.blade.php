@foreach ($data->profile->dapil->parlement as $modalParlement)
<div class="modal fade" tabindex="-1" role="dialog" id="detailParlement{{$modalParlement->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Visi Dan Misi "{{$modalParlement->name}}"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <b>Visi</b>
                <p>{{$modalParlement->visi}}</p>
                <b class="mt-3">Misi</b>
                <p>{{$modalParlement->misi}}</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
