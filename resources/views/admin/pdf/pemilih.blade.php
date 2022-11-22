<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ public_path('bootstrap/css/bootstrap.min.css') }}">

    <title>Daftar Pemilih</title>
</head>

<body>
    <div class="container">
        <center>
            <h3>Daftar Pemilih</h3>
        </center>
        <center>
            <h5>{{$data->name}}</h5>
        </center>
        <p>{{$date}}</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Dapil</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->pemilih as $data)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$data->user->username}}</td>
                    <td>{{$data->user->password}}</td>
                    <td>{{$data->dapil->name}}</td>
                    @if ($data->status == 'voted')
                    <td>Memilih</td>
                    @else
                    <td>Belum Memilih</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
