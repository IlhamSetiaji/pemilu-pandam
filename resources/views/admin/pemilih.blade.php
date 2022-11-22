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
                        <h1>Halaman Data Pemilih "{{$data->name}}"</h1>
                    </div>
                    <div class="section-body">
                        <div class="card-body p-0">
                            <a class="btn btn-primary" href="#" data-toggle="modal"
                                data-target="#modalCreateData">Tambah Data Pemilih</a>
                            {{-- <a href="{{url('admin/'.$data->id.'/print')}}" class="btn btn-info btn-disable">Cetak Data</a> --}}
                            </br></br>
                            <div class="table-responsive p-3">
                                <table class="table" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Dapil</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->pemilih as $p)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $p->user->name }}
                                            </td>
                                            <td>
                                                {{ $p->user->username }}
                                            </td>
                                            <td>
                                                {{ $p->user->password }}
                                            </td>
                                            <td>
                                                {{$p->dapil->name}}
                                            </td>
                                            <td>
                                                @if ($p->status == 'voted')
                                                <span class="badge badge-success">Sudah Memilih</span>
                                                @else
                                                <span class="badge badge-danger">Belum Memilih</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#modalDeleteData{{ $p->id }}">
                                                        <button type="button" class="btn btn-danger">Delete</button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
    @include('admin.modal.create-pemilih')
    @include('admin.modal.delete-pemilih')
    @include('stisla.script')
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#table').DataTable();
        });
    </script>
</body>

</html>
