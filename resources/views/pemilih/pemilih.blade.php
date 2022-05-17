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
                        <h1>Admin Page</h1>
                    </div>
                    <div class="section-body">
                        <h2 class="section-title">Hi, {{ auth()->user()->name }}</h2>
                        <p class="section-lead">
                            Welcome to pemilih page
                        </p>
                        <div class="row">
                            @foreach ($data as $d)
                            <div class="col-12 col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>{{ $d->name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="empty-state" data-height="400">
                                            <div class="empty-state-icon">
                                                <img src="{{ asset('data_calon/'.$d->pemilu->name.'/'.$d->name.'/photo/'.$d->photo) }}" class="img-fluid" alt="...">
                                            </div>
                                            <h2>Visi</h2>
                                            <p class="lead">
                                                {{ $d->visi }}
                                            </p>
                                            <h2>Misi</h2>
                                            <p class="lead">
                                                {{ $d->misi }}
                                            </p>
                                            @if ($user->status == 'BELUM')
                                            <a href="{{ url('/'.$d->id.'/pilih') }}" class="btn btn-primary mt-4">Pilih Ketua</a>
                                            @else
                                            <a href="#" class="btn btn-danger mt-4">Hak Pilih Sudah Habis</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endforeach
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

    @include('stisla.script')
</body>

</html>
