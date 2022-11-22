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
                        <h1>Presiden dan Wakil Presiden</h1>
                    </div>
                    <div class="section-body">
                        <div class="container mb-4">
                            <center><button class="btn btn-danger" type="button" id="countup">Mulai Hitung</button></center>
                        </div>
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
                                                <img src="{{url('storage/public/'.$president->photo)}}"
                                                    class="img-fluid" alt="{{$president->name}}">
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
                                            <h4 class="counter mt-4 text-dark"
                                                data-count="{{$president->votes->count()}}">0</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="container" id="dapil">
                        <center><h5 class="mb-4 mt-4">Hasil Tiap Dapil</h5></center>
                        <div class="row">
                            @forelse ($pemilu->dapil as $dapil)
                            <div class="col-md-{{$col}}">
                                <center>
                                    <a href="{{url('admin/'.Crypt::encrypt($dapil->id).'/hasil/dapil')}}" class="btn btn-success">Hasil {{$dapil->name}}</a>
                                </center>
                            </div>
                            @empty
                                <h5>Pemilu Ini Tidak Memiliki Dapil</h5>
                            @endforelse
                        </div>
                    </div>
            </section>
        </div>
        <footer class="main-footer">
            @include('stisla.footer')
        </footer>
    </div>
    </div>

    @include('stisla.script');
    <script>
        $(document).ready(function() {
            $('#dapil').hide();
        });
    </script>
    @include('stisla.countup');
</body>

</html>
