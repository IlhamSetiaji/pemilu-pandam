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
                        <h1>Perwakilan <b>"{{$dapil->name}}"</b></h1>
                    </div>
                    {{-- Dema --}}
                    <div class="section-body mt-5">
                        <center>
                            <h5 class="mb-5">"{{$dapil->pemilih->count()}}" Total Suara |
                                "{{$dapil->pemilih->where('status', 'voted')->count()}}" Total Suara Masuk</h5>
                            <br>
                            <div class="container mt-4 mb-4">
                                <div class="container mb-4">
                                    <center><button class="btn btn-danger" type="button" id="countup">Mulai
                                            Hitung</button></center>
                                </div>
                            </div>
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
                                                <img src="{{url('storage/public/'.$parlement->photo)}}"
                                                    class="img-fluid" alt="{{$dapil->name}}">
                                            </div>
                                            <h2>Jumlah Suara</h2>
                                            <h4 class="counter mt-4 text-dark" data-count="{{$parlement->votes->count()}}">0</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- This is where your code ends -->
                    </div>
                    <div class="container" id="dapil">
                        <center>
                            <h5 class="mb-4 mt-4">Hasil Tiap Dapil</h5>
                        </center>
                        <div class="row">
                            @forelse ($all as $dapilAll)
                            @if ($dapilAll->id != $dapil->id)
                            <div class="col-md-{{$col}}">
                                <center>
                                    <a href="{{url('admin/'.Crypt::encrypt($dapilAll->id).'/hasil/dapil')}}"
                                        class="btn btn-success">Hasil {{$dapilAll->name}}</a>
                                </center>
                            </div>
                            @endif
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
        $(document).ready(function () {
            $('#dapil').hide();
        });

    </script>
    @include('stisla.countup');
</body>

</html>
