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
                        <h1>Halaman Data Calon Legislatif</h1>
                    </div>
                    <div class="section-body">
                        <div class="card-body p-0">
                            <a class="btn btn-primary"
                                href="{{url('admin/parlement/'.Crypt::encrypt($data->id).'/create')}}">Tambah
                                Data Parlement</a></br></br>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Name</th>
                                            <th>Visi</th>
                                            <th>Misi</th>
                                            <th>Photo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->parlement as $p)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $p->name }}
                                            </td>
                                            <td>
                                                {{ $p->visi }}
                                            </td>
                                            <td>
                                                {{$p->misi}}
                                            </td>
                                            <td>
                                                <img src="{{url('storage/public/'.$p->photo)}}" alt="Foto Caleg" width="70px">
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a
                                                        href="{{url('admin/parlement/'.Crypt::encrypt($p->id).'/edit')}}">
                                                        <button type="button" class="btn btn-warning mr-2">Edit</button>
                                                    </a>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#deleteParlement{{ $p->id }}"
                                                        class="btn btn-danger mr-2">Delete</button>
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
    @include('stisla.script')
    @include('admin.modal.delete-parlement');
</body>

</html>
