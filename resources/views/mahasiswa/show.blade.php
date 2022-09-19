@extends('layouts.app')
 
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 40rem;">
        <div class="card-header bg-success">
        <h2>Detail Data Mahasiswa<h2>
        </div> <div class="card-body">
                <ul class="list-group list-group-flush"> 
                    <li class="list-group-item" align="middle">
                    <img width="100px" height="100px" src="{{asset('storage/'.$data->avatar)}}" align="middle"></li>
                    <li class="list-group-item"><b>Nama Mahasiswa: </b>{{$data->nama}}</li> 
                    <li class="list-group-item"><b>Username: </b>{{$data->username}}</li> 
                    <li class="list-group-item"><b>Email: </b>{{$data->email}}</li> 
                    <li class="list-group-item"><b>Password Akun: </b>{{$data->password}}</li> 
                     </ul>
        </div>
            <a class="btn btn-success mt-3" href="{{ route('mahasiswa.index') }}" style="font-size: 20px;">Kembali</a>
        </div>
    </div>
</div>
@endsection
 