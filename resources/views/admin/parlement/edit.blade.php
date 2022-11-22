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
                        <h1>Halaman Data Calon Legislatif</h1>
                    </div>
                    <div class="section-body">
                        <div class="card-body p-0">
                            <div class="container">
                                <form action="{{url('admin/parlement/'.Crypt::encrypt($data->id).'/update')}}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="">Nama Calon Legislatif</label>
                                        <input type="text" class="form-control" value="{{$data->name}}" name="name"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Foto Calon Legislatif</label>
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Assign Pemilu</label>
                                        <select class="form-control" name="dapil_id" id="exampleFormControlSelect1">
                                            <option value="">Pilih Dapil</option>
                                            @foreach ($dapil as $dapil)
                                            <option value="{{$dapil->id}}" @if ($dapil->id == $data->dapil_id)
                                                selected
                                            @endif>{{$dapil->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Visi</label>
                                        <textarea name="visi" id="visi" cols="30" rows="10" class="form-control"
                                            required>{{$data->visi}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Misi</label>
                                        <textarea name="misi" id="misi" cols="30" rows="10" class="form-control"
                                            required>{{$data->misi}}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                @include('stisla.footer')
            </footer>
        </div>
    </div>
    @include('stisla.script')
    @include('stisla.ckeditor')
</body>

</html>
