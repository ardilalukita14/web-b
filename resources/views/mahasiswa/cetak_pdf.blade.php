@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2 style="text-align: center">DATA MAHASISWA POLITEKNIK NEGERI MALANG</h2>
            </div>
            <img src="images/polinema.png" alt="Polinema" width="200px" height="200px" style="margin-left: 180px">
            <br></br>
            <br></br>
    <table class="table" style="margin-left:-60px;">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Username</th>
            <th>Password</th>
            <th>Foto</th>
        </tr>
        @foreach ($data as $mahasiswa)
        <tr>  
            <td>{{ $mahasiswa->nama }}</td>
            <td>{{ $mahasiswa->email }}</td>
            <td>{{ $mahasiswa->username }}</td>
            <td>{{ $mahasiswa->password }}</td>
            <td><img width="100px" src="{{
                    storage_path('app/public/'.$mahasiswa->avatar) }}" style="align: center"></td>
        </tr>
        @endforeach
                </table>
            </div>
        </div>
@endsection