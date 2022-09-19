@extends('layouts.app')
 
@section('content')
 
<div class="container mt-5">
 
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header bg-warning">
            Edit Data Produk
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
                <form method="POST" action="{{url('mahasiswa/'.$id)}}" enctype="multipart/form-data">
                        @csrf
                        {!! method_field('PUT') !!}
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required value="{{$data->username}}">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" class="form-control" name="nama" id="nama" required value="{{$data->nama}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Mahasiswa</label>
                        <input type="email" class="form-control" name="email" id="email" required value="{{$data->email}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password Akun</label>
                        <input type="password" class="form-control" name="password" id="password" required value="{{$data->password}}">
                    </div>
                    <div class="form-group">
                        <label>Foto Mahasiswa</label><br>
                        @if($data->avatar)
                        <img src="{{ asset('storage/'.$data->avatar) }}" alt="" width="100px"><br>
                        @endif
                        <br>
                        <input type="file" name="berkas" class="form-control" id="berkas" value="{{ $data->avatar }}" 
                        required accept=".jpg,.png"></br>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    @if(isset($error))
                        {{ $error }}
                    @endif
                </form>
@endsection