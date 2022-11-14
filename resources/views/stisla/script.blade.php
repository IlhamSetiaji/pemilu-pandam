<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('Stisla/assets/js/stisla.js') }}"></script>

<!-- JS Libraies -->
<script src="{{ asset('Stisla/node_modules/cleave.js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('Stisla/node_modules/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
<script src="{{ asset('Stisla/node_modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
<script src="{{ asset('Stisla/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('Stisla/node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('Stisla/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('Stisla/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('Stisla/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('Stisla/node_modules/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('Stisla/node_modules/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('Stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('Stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('Stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
<script src="{{ asset('Stisla/node_modules/chart.js/dist/Chart.min.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('Stisla/assets/js/scripts.js') }}"></script>
<script src="{{ asset('Stisla/assets/js/custom.js') }}"></script>
<script src="{{ asset('Stisla/node_modules/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('Stisla/node_modules/prismjs/prism.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('Stisla/assets/js/page/forms-advanced-forms.js') }}"></script>
<script src="{{ asset('Stisla/assets/js/page/components-table.js') }}"></script>
<script src="{{ asset('Stisla/assets/js/page/bootstrap-modal.js') }}"></script>
<script src="{{ asset('Stisla/assets/js/page/auth-register.js') }}"></script>
<script src="{{ asset('Stisla/assets/js/page/modules-datatables.js') }}"></script>
{{-- <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Sunday", "Monday", "Tuesday"],
            datasets: [{
                label: 'Statistics',
                data: [0, 460, 0],
                borderWidth: 2,
                backgroundColor: 'rgba(63,82,227,.8)',
                borderWidth: 0,
                borderColor: 'transparent',
                pointBorderWidth: 0,
                pointRadius: 3.5,
                pointBackgroundColor: 'rgba(254,86,83,.7)',
                pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
            }, {
                label: 'Statistics',
                data: [0, 390, 0],
                borderWidth: 2,
                backgroundColor: 'rgba(254,86,83,.7)',
                borderWidth: 0,
                borderColor: 'transparent',
                pointBorderWidth: 0,
                pointRadius: 3.5,
                pointBackgroundColor: 'rgba(63,82,227,.8)',
                pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 200,
                        callback: function(value, index, values) {
                            return '$' + value;
                        }
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false,
                        tickMarkLength: 15,
                    }
                }]
            },
        }
    });
</script> --}}
{{-- <script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Looping tension',
                data: [65, 59, 80, 81, 26, 55, 40],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
            }]
        },
        options: {
            legend: {
                display: true,
            },
            animations: {
                tension: {
                    duration: 1000,
                    easing: 'linear',
                    from: 1,
                    to: 0,
                    loop: true
                }
            },
            scales: {
                y: { // defining min and max so hiding the dataset does not change scale range
                    min: 0,
                    max: 100
                }
            }
        }
    });
</script> --}}
