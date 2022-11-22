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
                        <h1>Halaman Data Calon Ketua OSIS</h1>
                    </div>
                    <div class="section-body">
                        <div class="card-body p-0">
                            <a class="btn btn-primary" href="#" data-toggle="modal"
                                data-target="#modalCreateData">Tambah Calon Ketua</a></br></br>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Name</th>
                                            <th>Kelas</th>
                                            <th>Pemilu</th>
                                            <th>Visi</th>
                                            <th>Misi</th>
                                            <th>Photo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($osis as $key => $o)
                                        <tr>
                                            <td class="text-center">
                                                {{ $key+1 }}
                                            </td>
                                            <td>
                                                {{ $o->name }}
                                            </td>
                                            <td>
                                                {{ $o->kelas }}
                                            </td>
                                            <td>
                                                {{ $o->pemilu->name }}
                                            </td>
                                            <td>
                                                {{ $o->visi}}
                                            </td>
                                            <td>
                                                {{ $o->misi }}
                                            </td>
                                            <td>
                                                <a href="#" data-toggle="modal"
                                                    data-target="#modalShowData{{ $o->id }}">
                                                    <button type="button" class="btn btn-info">Lihat Foto</button>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#modalUpdateData{{ $o->id }}">
                                                        <button type="button" class="btn btn-warning">Edit</button>
                                                    </a>
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#modalDeleteData{{ $o->id }}">
                                                        <button type="button" class="btn btn-danger">Delete</button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <!-- This is where your code ends -->
                        </div>
                        <!-- This is where your code ends -->
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                @include('stisla.footer')
            </footer>
        </div>
    </div>
    @include('admin.modal.create-calon')
    @include('admin.modal.show-calon-photo')
    @include('admin.modal.update-calon')
    @include('admin.modal.delete-calon')
    @include('stisla.script')
</body>

</html>
