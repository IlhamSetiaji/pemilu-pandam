@foreach ($data->profile->pemilu->president as $modalPresident)
<div class="modal fade" tabindex="-1" role="dialog" id="detailPresident{{$modalPresident->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Visi Dan Misi "{{$modalPresident->name}}"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <b>Visi</b>
                <p>{{$modalPresident->visi}}</p>
                <b class="mt-3">Misi</b>
                <p>{{$modalPresident->misi}}</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
