<!--Modal Tambah Data-->
@foreach ($data->president as $p)
<div class="modal fade" tabindex="-1" role="dialog" id="deletePresident{{ $p->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete President</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus {{$p->name}} dari <b>{{ $data->name }}</b>?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ url('/admin/president/'.Crypt::encrypt($p->id).'/delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            style="transform: translateX(-80%); width: 174px; border-radius: 30px; background-color: #ff0000;"
                            class="btn text-white">Delete</button>
                    </form>
                </div>
        </div>
    </div>
</div>
@endforeach
