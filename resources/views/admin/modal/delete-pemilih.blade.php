<!--Modal Tambah Data-->
@foreach ($data->pemilih as $p)
<div class="modal fade" tabindex="-1" role="dialog" id="modalDeleteData{{ $p->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Pemilih</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus {{$p->user->username}} dari {{ $data->name }}?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ url('/admin/pemilih/'.Crypt::encrypt($p->user->id).'/delete') }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                    {{-- <a type="button" href="{{ url('/admin/pemilih/'.Crypt::encrypt($p->id).'/delete') }}"
                        style="transform: translateX(-80%); width: 174px; border-radius: 30px; background-color: #ff0000;"
                        class="btn text-white">Delete</a> --}}
                </div>
        </div>
    </div>
</div>
@endforeach
