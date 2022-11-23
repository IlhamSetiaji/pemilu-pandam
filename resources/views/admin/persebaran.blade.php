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
                    <div class="section-header">
                        <h1>Total Hak Suara : <b>"{{$data->pemilih->count()}}"</b> | Suara Digunakan : <b>"{{$data->where('status', 'voted')->count()}}"</b></h1>
                    </div>
                    <div class="section-body mt-5">
                        <div class="row">
                            @foreach ($data->dapil as $dapil)
                            <div class="col-12 col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>{{ $dapil->name }}</h4>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="empty-state">
                                            <div class="container">
                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdK51iQYUXz5QL3MyTFfA0YaX5HJutFScqqg&usqp=CAU"
                                                    class="img-fluid" alt="{{$dapil->name}}">
                                            </div>
                                            <h6 class="mt-5">Hak Suara</h6>
                                            <h6 class="counter text-dark">{{$dapil->pemilih->count()}}</h6>
                                            <h6 class="mt-3">Hak Suara Digunakan</h6>
                                            <h6 class="counter text-dark">{{$dapil->pemilih->where('status', 'voted')->count()}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
</body>

</html>
