<!DOCTYPE html>
<html lang="en">

<head>
    @include('stisla.head')
</head>

<body>
    <div id="app">
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
            <div class="d-flex flex-wrap align-items-stretch">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="p-4 m-3">
                        <img src="data:image/png;base64,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" alt="logo" width="80"
                            class="shadow-light rounded-circle mb-5 mt-2">
                        <h4 class="text-dark font-weight-normal">Welcome to <span class="font-weight-bold">Pemilu Sekolah Vokasi UNS</span>
                        </h4>
                        <p class="text-muted">Before you get started, you must login or register if you don't already
                            have an account.</p>
                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control" name="username" tabindex="1"
                                    required autofocus>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password"
                                    tabindex="2" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right"
                                    tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-5 text-small">
                            Copyright &copy; Pemilu Sekolah Vokasi UNS. Made by Nathan Ilham
                            <div class="mt-2">
                                <a href="#">Privacy Policy</a>
                                <div class="bullet"></div>
                                <a href="#">Terms of Service</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 position-relative overlay-gradient-bottom"
                    style="background-image:url('https://i0.wp.com/uns.ac.id/id/wp-content/uploads/Preview.png?w=1171&ssl=1')">
                    <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                                <h1 class="mb-2 display-4 font-weight-bold">Sekolah Vokasi UNS</h1>
                                <h5 class="font-weight-normal text-muted-transparent">Surakarta, Indonesia</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('stisla.script')
</body>

</html>
