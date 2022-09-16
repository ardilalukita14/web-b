@extends('layouts.app')
 
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
        <div class="card-header bg-success">
        Detail Produk
        </div> <div class="card-body">
                <ul class="list-group list-group-flush"> 
                    <li class="list-group-item" align="middle">
                    <img width="100px" height="100px" src="{{asset('storage/'.$data->gambar)}}" align="middle"></li>
                    <li class="list-group-item"><b>Nama Produk: </b>{{$data->nama}}</li> 
                    <li class="list-group-item"><b>Deskripsi Produk: </b>{{$data->deskripsi}}</li> 
                     </ul>
        </div>
            <a class="btn btn-success mt-3" href="{{ route('products.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection
 