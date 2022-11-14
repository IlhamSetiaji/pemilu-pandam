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
                        <h1>Admin Page</h1>
                    </div>
                    <div class="section-body">
                        <h2 class="section-title">Hi, {{ auth()->user()->name }}</h2>
                        <p class="section-lead">
                            Welcome to admin page
                        </p>
                        @if (!$pemilu)
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="hero text-white hero-bg-image hero-bg-parallax"
                                        data-background="{{ asset('Stisla/assets/img/unsplash/andre-benz-1214056-unsplash.jpg') }}">
                                        <div class="hero-inner">
                                            <h2>Countdown Pemilu</h2>
                                            <p class="lead">Sepertinya hasil dari pemilu belum bisa ditampilkan karena
                                                waktu pemilu belum berakhir</p>
                                            <div class="mt-4">
                                                <a href="#"
                                                    class="btn btn-outline-white btn-lg btn-icon icon-left"><i
                                                        class="fas fa-stopwatch"></i>
                                                    <p id="demo"></p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- <canvas id="myChart" width="100" height="100"></canvas> --}}
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <button class="btn btn-info" id='start_call'>Lihat Hasil Pemilu</button>
                                    <div id='loading'></div>
                                </div>
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

    @include('stisla.script')
    <script>
        // Set the date we're counting down to
        // var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();
        var countDownDate = new Date("<?php echo $endDate; ?>").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

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
        var url = <?php echo json_encode($url); ?>

        /*This is an example function and can be disregarded
        This function sets the loading div to a given string.*/
        function loaded() {
            window.location.replace(url);
        }

        function startLoad() {
            /*This is the loading gif, It will popup as soon as startLoad is called*/
            $('#loading').html(
                '<img style="width: 800px;" src="https://i.pinimg.com/originals/56/b9/af/56b9af0fd3c116c9333cd87f1c731658.gif"/>'
            );
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
            clearTimeout(timeout);
            /*Set timeout delays a given function for given milliseconds*/
            timeout = setTimeout(loaded, 10000);
        }
        /*This binds a click event to the refresh button*/
        $('#start_call').click(startLoad);
        /*This starts the load on page load, so you don't have to click the button*/
        // startLoad();
    </script>
</body>

</html>
