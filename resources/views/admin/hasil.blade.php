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
                        <h1>Halaman Hasil Suara</h1>
                    </div>
                    <div class="section-body">
                        <center>
                            <h2 class="mb-5 mt-3">Presiden dan Wakil Presiden</h2>
                        </center>
                        <div class="row">
                            @foreach ($pemilu->president as $president)
                            <div class="col-12 col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>{{ $president->name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="empty-state">
                                            <div class="container">
                                                <img src="{{url('storage/'.$president->photo)}}" class="img-fluid"
                                                    alt="{{$president->name}}">
                                            </div>
                                            <h2>Visi</h2>
                                            <p class="lead">
                                                {{ $president->visi }}
                                            </p>
                                            <h2>Misi</h2>
                                            <p class="lead">
                                                {{ $president->misi }}
                                            </p>
                                            <h2>Jumlah Suara</h2>
                                            <a href="#"
                                                class="btn btn-primary mt-4">{{ $president->votes->count() }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- This is where your code ends -->
                    </div>
                    {{-- Dema --}}
                    @foreach ($pemilu->dapil as $dapil)
                    <div class="section-body mt-5">
                        <center>
                            <h2 class="mb-5 mt-3">Perwakilan <b>"{{$dapil->name}}"</b></h2>
                            <h5 class="mb-5">"{{$dapil->pemilih->count()}}" Suara Masuk</h5>
                            <br>
                        </center>
                        <div class="row">
                            @foreach ($dapil->parlement as $parlement)
                            <div class="col-12 col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>{{ $parlement->name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="empty-state">
                                            <div class="container">
                                                <img src="{{url('storage/'.$parlement->photo)}}" class="img-fluid" alt="{{$president->name}}">
                                            </div>
                                            <h2>Jumlah Suara</h2>
                                            <a href="#" class="btn btn-primary mt-4">{{ $parlement->votes->count() }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                            </div>
                            <!-- This is where your code ends -->
                        </div>
                    @endforeach
                </section>
            </div>
            <footer class="main-footer">
                @include('stisla.footer')
            </footer>
        </div>
    </div>

    @include('stisla.script')
</body>

</html>
