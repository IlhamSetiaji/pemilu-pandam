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
                    <a type="button" href="{{ url('/admin/pemilu/'.$p->id.'/update-status') }}"
                        style="transform: translateX(-80%); width: 174px; border-radius: 30px; background-color: #4285F4;"
                        class="btn text-white">Update</a>
                </div>
        </div>
    </div>
</div>
@endforeach