<!DOCTYPE html>
<html lang="en">

<head>
    @include('stisla.head')
</head>
<style>
    label {
        width: 100%;
    }

    .card-input-element {
        display: none;
    }

    .card-input {
        margin: 10px;
        padding: 0px;
    }

    .card-input:hover {
        cursor: pointer;
    }

    .card-input-element:checked+.card-input {
        box-shadow: 0 0 1px 1px #2ecc71;
    }

</style>

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
                        <h1>Admin Page</h1>
                    </div>
                    <div class="section-body">
                        @if ($data->profile->status != 'voted')
                        <h2 class="section-title">Hi, {{ $data->username }}</h2>
                        <p class="section-lead">
                            Selamat Datang di Halaman Pemungutan Suara!!!
                        </p>
                        <form action="{{url(Crypt::encrypt($data->id).'/vote')}}" id="vote" method="POST">
                            @csrf
                            <div class="container-fluid">
                                <h1 class="mb-4">Pilih <b>"Presiden dan Wakil Presiden"</b></h1>
                                <div class="row">
                                    @forelse ($data->profile->pemilu->president as $president)
                                    <div class="col-md-6 col-lg-4">

                                        <label>
                                            <input type="radio" name="president" value="{{$president->id}}"
                                                class="card-input-element" />

                                            <div class="card card-default card-input">
                                                <div class="card-header">
                                                    <img src="{{url('storage/'.$president->photo)}}" alt=""
                                                        width="100%">
                                                </div>
                                                <div class="card-body">
                                                    <b>Presiden dan Wakil Presiden</b>
                                                    <p>{{$president->name}}</p>
                                                    <center>
                                                        <button class="btn btn-info mt-3" type="button" data-toggle="modal" data-target="#detailPresident{{$president->id}}">Detail</button>
                                                    </center>
                                                </div>
                                            </div>

                                        </label>

                                    </div>
                                    @empty
                                    Empty Data
                                    @endforelse
                                </div>
                                {{-- Dema --}}
                                <h1 class="mb-4 mt-3">Pilih Dewan Mahasiswa <b>"{{$data->profile->dapil->name}}"</b>
                                </h1>

                                <div class="row">
                                    @forelse ($data->profile->dapil->parlement as $parlement)
                                    <div class="col-md-6 col-lg-4">

                                        <label>
                                            <input type="radio" name="parlement" value="{{$parlement->id}}"
                                                class="card-input-element" />

                                            <div class="card card-default card-input">
                                                <div class="card-header">
                                                    <img src="{{url('storage/'.$parlement->photo)}}" alt="{{$parlement->name}}" width="100%">
                                                </div>
                                                <div class="card-body">
                                                    <b>Nama Calon Anggota DEMA</b>
                                                    <p>{{$parlement->name}}</p>
                                                    <center>
                                                        <button class="btn btn-info mt-3" type="button" data-toggle="modal" data-target="#detailParlement{{$parlement->id}}">Detail</button>
                                                    </center>
                                                </div>
                                            </div>

                                        </label>

                                    </div>
                                    @empty
                                    Empty Data
                                    @endforelse
                                </div>
                                <div class="container mt-4">
                                    <button class="btn btn-success btn-lg btn-block" type="button" data-toggle="modal" data-target="#confirmation">Yakin dan Simpan Pilihan</button>
                                </div>
                            </div>
                        </form>
                        @else
                        <div class="alert alert-success" role="alert">
                            Anda sudah memilih, semoga pilihan anda dapat membawa sv lebih baik lagi
                        </div>
                        @endif
                        <!-- This is where your code ends -->
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                @include('stisla.footer')
            </footer>
        </div>
    </div>
    {{-- @include('pemilih.modal.show-calon-photo') --}}
    @include('stisla.script')
    @include('pemilih.modal.detail-president');
    @include('pemilih.modal.detail-parlement');
    @include('pemilih.modal.confirmation');
</body>

</html>
