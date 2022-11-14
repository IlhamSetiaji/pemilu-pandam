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
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Hasil Pemilu</h4>
                                            <div class="card-header-action">
                                                <a href="#summary-chart" data-tab="summary-tab"
                                                    class="btn active">Chart</a>
                                                <a href="#summary-text" data-tab="summary-tab" class="btn">Text</a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="summary">
                                                <div class="summary-info" data-tab-group="summary-tab"
                                                    id="summary-text">
                                                    <h4>$1,858</h4>
                                                    <div class="text-muted">Sold 4 items on 2 customers</div>
                                                    <div class="d-block mt-2">
                                                        <a href="#">View All</a>
                                                    </div>
                                                </div>
                                                <div class="summary-chart active" data-tab-group="summary-tab"
                                                    id="summary-chart">
                                                    <canvas id="myChart2" height="180"></canvas>
                                                </div>
                                                <div class="summary-item">
                                                    <h6 class="mt-3">Item List <span class="text-muted">(4
                                                            Items)</span>
                                                    </h6>
                                                    <ul class="list-unstyled list-unstyled-border">
                                                        @foreach ($result->president as $value)
                                                            <li class="media">
                                                                <a href="#">
                                                                    <img alt="image" class="mr-3 rounded"
                                                                        width="50"
                                                                        src="https://i.idol.st/u/card/transparent/407UR-Osaka-Shizuku-I-Wanted-to-Say-This-through-Chocolate-Sweet-Choco-OTrRHH.png">
                                                                </a>
                                                                <div class="media-body">
                                                                    <div class="media-right">
                                                                        {{ $value->votes->count() }} suara</div>
                                                                    <div class="media-title"><a
                                                                            href="#">{{ $value->name }}</a>
                                                                    </div>
                                                                    <div class="text-small text-muted"><a
                                                                            href="#">{{ $result->name }}</a>
                                                                        <div class="bullet"></div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
        function generateDarkColorRgb() {
            const red = Math.floor(Math.random() * 256 / 2);
            const green = Math.floor(Math.random() * 256 / 2);
            const blue = Math.floor(Math.random() * 256 / 2);
            return "rgb(" + red + ", " + green + ", " + blue + ")";
        }
        var president = <?php echo json_encode($president); ?>;
        var count = <?php echo json_encode($count); ?>;
        var ctx = document.getElementById("myChart2").getContext('2d');
        window.myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Hasil Pemilu"],
                datasets: []
            },
            options: {
                legend: {
                    display: true,
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 150
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });
        for (var i = 0; i < president.length; i++) {
            var color = generateDarkColorRgb();
            myChart.data.datasets.push({
                label: president[i],
                data: [count[i]],
                borderWidth: 2,
                backgroundColor: color,
                borderColor: 'transparent',
                borderWidth: 0,
                pointBackgroundColor: '#999',
                pointRadius: 4
            });
        }
        window.myChart.update();
    </script>
</body>

</html>
