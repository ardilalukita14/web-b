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
                <form method="post" action="{{ route('product.update', $product->id) }}" id="myForm" enctype="multipart/form-data">
                @csrf
                @method('PUT') 
                    <div class="form-group">
                        <label for="namaproduk">Nama Produk</label>
                        <input type="text" class="form-control" name="namaproduk" id="namaproduk" value="{{ $product->nama }}" aria-describedby="nama">
                    </div>
                    <div class="form-group">
                        <label for="deskripsiproduk">Deskripsi Produk</label>
                        <input type="text" class="form-control" name="deskripsiproduk" id="deskripsiproduk" value="{{ $product->deskripsi}}" aria-describedby="deskripsi">
                    </div>
                    <div class="form-group">
                    <label>Gambar Produk</label>
                    <input type="file" name="formFile" class="form-control" id="formFile" value="{{ $product->gambar }}" 
                    required="required" aria-describedby="formFile" ></br>
                    <img src="{{asset('storage/'.$product->gambar)}}" style="width: 200px; height: 200px;">
                    </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection