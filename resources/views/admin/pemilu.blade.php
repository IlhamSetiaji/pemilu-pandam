<!DOCTYPE html>
<html lang="en">

<head>
    @include('stisla.head')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('stisla.navbar')
            @include('stisla.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-warning alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ $error }}
                        </div>
                    </div>
                    @endforeach
                    @endif
                    @if (session('status'))
                    <div class="alert alert-info alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('status') }}
                        </div>
                    </div>
                    @endif
                    <div class="section-header">
                        <h1>Halaman Data Pemilu</h1>
                    </div>
                    <div class="section-body">
                        <div class="card-body p-0">
                            <a class="btn btn-primary" href="#" data-toggle="modal"
                                data-target="#modalCreateData">Tambah Data Pemilu</a></br></br>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pemilu as $key => $p)
                                        <tr>
                                            <td class="text-center">
                                                {{ $key+1 }}
                                            </td>
                                            <td>
                                                {{ $p->name }}
                                            </td>
                                            <td>
                                                {{ $p->start_date }}
                                            </td>
                                            <td>
                                                {{ $p->end_date }}
                                            </td>
                                            <td>
                                                @if ($p->status == 'ACTIVE')
                                                <span class="badge badge-success">Aktif</span>
                                                @else
                                                <span class="badge badge-danger">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    @if ($p->status == 'ACTIVE')
                                                    <a href="{{ url('admin/'.$p->id.'/hasil') }}"
                                                        class="btn btn-outline-success mr-2">Hasil</a>
                                                    <a href="{{ url('admin/'.Crypt::encrypt($p->id).'/pemilih') }}"
                                                        class="btn btn-success mr-2">Lihat Pemilih</a>
                                                    @endif
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#modalUpdateStatus{{ $p->id }}">
                                                        <button type="button" class="btn btn-info mr-2">Ubah Status</button>
                                                    </a>
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#modalUpdateData{{ $p->id }}">
                                                        <button type="button" class="btn btn-warning mr-2">Edit</button>
                                                    </a>
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#modalDeleteData{{ $p->id }}">
                                                        <button type="button" class="btn btn-danger mr-2">Delete</button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                @include('stisla.footer')
            </footer>
        </div>
    </div>
    @include('admin.modal.create-pemilu')
    @include('admin.modal.update-pemilu')
    @include('admin.modal.update-pemilu-status')
    @include('admin.modal.delete-pemilu')
    @include('stisla.script')
</body>

</html>
