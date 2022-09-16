@extends('layouts.app')
 
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
        <div class="card-header bg-info">
        <h2>Tambahkan Produk</h2>
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
            <form method="POST" action="{{ route('product.store') }}" id="myForm" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="namaproduk">Nama Produk</label>
                <input type="text" class="form-control" name="namaproduk" id="namaproduk" placeholder="example: Baju tidur">
            </div>
            <div class="form-group">
                <label for="deskripsiproduk">Deskripsi</label>
                <input type="text" class="form-control" name="deskripsiproduk" id="deskripsiproduk" placeholder="Password">
            </div>
            <div class="mb-3">
            <label for="formFile" class="form-label">Gambar Produk</label>
            <input name="formFile" class="form-control" type="file" id="formFile">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3" style="margin-left: -15px;">Submit</button>
            </div>

        </form>
    </div>
    </body>
</html>