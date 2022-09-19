@extends('layouts.app')
 
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 40rem;">
        <div class="card-header bg-info">
        <h2>Tambah Data Mahasiswa</h2>
        </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('mahasiswa.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama Mahasiswa</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email Mahasiswa</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password Akun</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="mb-3">
            <label for="berkas" class="form-label">Foto Mahasiswa</label>
            <input name="berkas" class="form-control" type="file" id="berkas" required accept=".jpg,.png">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3" style="margin-left: -15px;">Submit</button>
            </div>

        </form>
    </div>
@endsection