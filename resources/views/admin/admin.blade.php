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
                        <h1>
                            Dashboard Utama
                        </h1>
                    </div>
                    <div class="section-body">
                        <h2 class="section-title">Hi, {{ auth()->user()->name }}</h2>
                        <p class="section-lead">
                            Selamat Datang di Halaman Admin
                        </p>
                        <div class="row mb-4 p-3">
                            @forelse ($pemilu as $pemilu)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>{{$pemilu->name}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="empty-state">
                                            <div class="container">
                                                <img src="https://www.niaga.asia/wp-content/uploads/2019/12/kpu_-_okezone_news_0-1.jpg"
                                                    class="img-fluid" alt="{{$pemilu->name}}">
                                            </div>
                                            <h2>Jumlah Pemilih</h2>
                                            <p class="lead">
                                                {{ $pemilu->pemilih->count() }}
                                            </p>
                                            <h2>Hak Suara yang Digunakan</h2>
                                            <p class="lead">
                                                {{ $pemilu->pemilih->where('status', 'voted')->count() }}
                                            </p>
                                        </div>
                                        <center>
                                        <button class="btn btn-info mb-4" id="start_call" data-pemilu="{{Crypt::encrypt($pemilu->id)}}">Hasil
                                            "{{$pemilu->name}}"</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-warning" role="alert">
                                Anda Belum Memiliki Data Pemilu
                            </div>
                        @endforelse
                    </div>
                    <div id='loading'></div>
            </div>
            </section>
        </div>
        <footer class="main-footer">
            @include('stisla.footer')
        </footer>
    </div>
    </div>

    @include('stisla.script')
    <script>
        // Set the date we're counting down to
        // var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();
        var countDownDate = new Date("<?php echo $endDate; ?>").getTime();

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("demo").innerHTML = days + " hari " + hours + " jam " +
                minutes + " menit " + seconds + " detik lagi";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);

    </script>
    <script>
        /*This makes the timeout variable global so all functions can access it.*/
        var timeout;
        var url = {!! json_encode(url('admin')) !!}

        /*This is an example function and can be disregarded
        This function sets the loading div to a given string.*/
        function loaded(pemilu) {
            window.location.replace(url + "/" + pemilu + "/hasil");
        }

        function startLoad(pemilu) {
            /*This is the loading gif, It will popup as soon as startLoad is called*/
            $('#loading').html(
                '<img style="width: 100%;" src="https://i.pinimg.com/originals/56/b9/af/56b9af0fd3c116c9333cd87f1c731658.gif"/>'
            );

            var target = $('#loading');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 500);
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    loaded(pemilu);
                }, 10000);
            }
            /*
            This is an example of the ajax get method,
            You would retrieve the html then use the results
            to populate the container.

            $.get('example.php', function (results) {
                $('#loading').html(results);
            });
            */
            /*This is an example and can be disregarded
            The clearTimeout makes sure you don't overload the timeout variable
            with multiple timout sessions.*/

            /*Set timeout delays a given function for given milliseconds*/
        }
        /*This binds a click event to the refresh button*/
        $('#start_call').on('click', function () {
            startLoad($(this).data('pemilu'));
        });
        /*This starts the load on page load, so you don't have to click the button*/
        // startLoad();

    </script>
</body>

</html>
