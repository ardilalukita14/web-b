@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2 style="text-align: center">DATA MAHASISWA POLITEKNIK NEGERI MALANG</h2>
            </div>
            <img src="images/polinema.png" alt="Polinema" width="200px" height="200px" style="margin-left: 450px">
            <br></br>
            <br></br>
            <!-- Form Search -->
            <div class="float-left my-2">
                <form action="{{ route('mahasiswa.index') }}" method="GET">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" name="search" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> Cari</button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- End Form Search -->
            <br></br>
            <div class="float-right my-2">
                <a class="btn btn-warning" href="{{ route('mahasiswa.create') }}">Tambah Data Mahasiswa</a><br></br>
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
            <th>Nama Mahasiswa</th>
            <th>Email Mahasiswa</th>
            <th>Foto Mahasiswa</th>
            <th width="250px">Action</th>
        </tr>
        @foreach ($mahasiswa as $data)
        <tr>
    
            <td>{{ $data->nama }}</td>
            <td>{{ $data->email }}</td>
            <td>
            <img width="100px" height="100px" style="margin-left:40px;" src="{{asset('storage/'.$data->avatar)}}">
            </td>
            <td>
            <form action="{{ route('mahasiswa.destroy',$data->user_id) }}" method="POST">   
                <a class="btn btn-info" href="{{ route('mahasiswa.show',$data->user_id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('mahasiswa.edit',$data->user_id) }}">Edit</a>
                @csrf 
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="float-right my-2">
                <a class="btn btn-secondary" href="{{ route('mahasiswa.cetak_pdf') }}">Cetak PDF</a>
            </div>
    <div class="d-flex justify-content-center">
        {{$mahasiswa->links()}}
    </div>
    
@endsection