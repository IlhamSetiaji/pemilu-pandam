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
                        <div class="row">
                            <div class="col-12">
                                <div id='loading'></div>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Hasil Pemilu</h4>
                                        <div class="card-header-action">
                                            <a href="#summary-chart" data-tab="summary-tab" class="btn active">Chart</a>
                                            @foreach ($result->president as $key => $value)
                                                <a href="#summary-text{{ $key }}" data-tab="summary-tab"
                                                    class="btn">{{ $value->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="summary">
                                            @foreach ($result->president as $key => $value)
                                                <div class="summary-info" data-tab-group="summary-tab"
                                                    id="summary-text{{ $key }}">
                                                    <h4>{{ $value->votes->count() }} suara</h4>
                                                    <div class="text-muted">{{ $value->name }}</div>
                                                    <div class="d-block mt-2">
                                                        <a href="#">{{ $result->name }}</a>
                                                    </div>
                                                </div>
                                            @endforeach
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
                                                                <img alt="image" class="mr-3 rounded" width="50"
                                                                    src="{{ url('storage/public/' . $value->photo) }}">
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
