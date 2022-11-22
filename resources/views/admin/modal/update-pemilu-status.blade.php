<!--Modal Tambah Data-->
@foreach ($pemilu as $p)
<div class="modal fade" tabindex="-1" role="dialog" id="modalUpdateStatus{{ $p->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Status Pemilu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin mengubah status dari {{ $p->name }}?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ url('/admin/pemilu/'.$p->id.'/update-status') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-warning text-white">Update</button>
                    </form>
                </div>
        </div>
    </div>
</div>
@endforeach
