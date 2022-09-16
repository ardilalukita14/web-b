@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2 style="text-align: center">DAFTAR PRODUK TOKO SERBA-ADA</h2>
            </div>
            <br></br>
            <!-- Form Search -->
            <div class="float-left my-2">
                <form action="{{ route('product.index') }}" method="GET">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" name="search" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i> Cari</button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- End Form Search -->
            <br></br>
            <div class="float-right my-2">
                <a class="btn btn-info" href="{{ route('product.create') }}">Tambah Produk Baru</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <table class="table table-bordered">
        <tr>
            <th>Nama Produk</th>
            <th>Deskripsi Produk</th>
            <th>Foto Produk</th>
            <th width="250px">Action</th>
        </tr>
        @foreach ($product as $data)
        <tr>
    
            <td>{{ $data->nama }}</td>
            <td>{{ $data->deskripsi }}</td>
            <td>
            <img width="100px" height="100px" src="{{asset('storage/'.$data->gambar)}}">
            </td>
            <td>
            <form action="{{ route('product.destroy',$data->id) }}" method="POST">   
                <a class="btn btn-info" href="{{ route('product.show',$data->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('product.edit',$data->id) }}">Edit</a>
                @csrf 
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center">
        {{$product->links()}}
    </div>
    
@endsection