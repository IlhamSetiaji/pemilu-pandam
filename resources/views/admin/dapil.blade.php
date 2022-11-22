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
                                data-target="#createDapil">Tambah Data Pemilu</a></br></br>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Name</th>
                                            <th>Created_At</th>
                                            <th>Pemilu</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $p)
                                        <tr>
                                            <td class="text-center">
                                                {{ $key+1 }}
                                            </td>
                                            <td>
                                                {{ $p->name }}
                                            </td>
                                            <td>
                                                {{ $p->created_at }}
                                            </td>
                                            <td>
                                                {{$p->pemilu->name}}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{url('admin/parlement/'.Crypt::encrypt($p->id).'/show')}}" class="btn btn-primary mr-2">Daftar Legislatif</a>
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#editDapil{{ $p->id }}">
                                                        <button type="button" class="btn btn-warning mr-2">Edit</button>
                                                    </a>
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#deleteDapil{{ $p->id }}">
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
    @include('stisla.script')
    @include('admin.modal.create-dapil')
    @include('admin.modal.edit-dapil');
    @include('admin.modal.delete-dapil');
</body>

</html>
