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
                            Welcome to pemilih page
                        </p>
                        <form action="{{url(Crypt::encrypt($data->id).'/vote')}}" method="POST">
                            @csrf
                            <div class="container-fluid">
                                <h1 class="mb-4">Pilih <b>"President dan Wakil President"</b></h1>
                                <div class="row">
                                    @forelse ($data->profile->pemilu->president as $president)
                                    <div class="col-md-4 col-lg-4 col-sm-4">

                                        <label>
                                            <input type="radio" name="president" value="{{$president->id}}"
                                                class="card-input-element" />

                                            <div class="card card-default card-input">
                                                <div class="card-header">
                                                    <img src="{{url('storage/'.$president->photo)}}" alt=""
                                                        width="450px" height="450px">
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">Nama President dan Wakil</th>
                                                                <td>{{$president->name}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <br>
                                                    <b>Visi</b>
                                                    <p>{{$president->visi}}</p>
                                                    <br>
                                                    <b>Misi</b>
                                                    <p>{{$president->visi}}</p>
                                                </div>
                                            </div>

                                        </label>

                                    </div>
                                    @empty
                                    Empty Data
                                    @endforelse
                                </div>

                            </div>
                            {{-- Dema --}}
                            <h1 class="mb-4 mt-3">Pilih Dewan Mahasiswa <b>"{{$data->profile->dapil->name}}"</b></h1>

                            <div class="row">
                                @forelse ($data->profile->dapil->parlement as $parlement)
                                <div class="col-md-4 col-lg-4 col-sm-4">

                                    <label>
                                        <input type="radio" name="parlement" value="{{$parlement->id}}"
                                            class="card-input-element" />

                                        <div class="card card-default card-input">
                                            <div class="card-header">
                                                <img src="{{url('storage/'.$parlement->photo)}}" alt="" width="450px"
                                                    height="450px">
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Nama President dan Wakil</th>
                                                            <td>{{$parlement->name}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <br>
                                                <b>Visi</b>
                                                <p>{{$parlement->visi}}</p>
                                                <br>
                                                <b>Misi</b>
                                                <p>{{$parlement->visi}}</p>
                                            </div>
                                        </div>

                                    </label>

                                </div>
                                @empty
                                Empty Data
                                @endforelse
                            </div>
                            <button class="btn btn-success" type="submit">Vote</button>
                        </form>
                        @else
                            <h2>Anda Sudah Melakukan Vote</h2>
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
</body>

</html>
