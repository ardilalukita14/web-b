<?php

namespace App\Http\Controllers;
use App\Models\Products;
use Illuminate\Http\Request;
use Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian nama
            $product = Products::where('nama', 'like', "%" . $request->search . "%")->paginate(5);
        } else { // Jika tidak melakukan pencarian judul
            //fungsi eloquent menampilkan product menggunakan pagination
            $product = Products::orderBy('id', 'desc')->paginate(5); // Pagination menampilkan 5 product
        }
        return view('products.index', compact('product')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $product = new Products;
        $product->nama = request('namaproduk');
        $product->deskripsi= request('deskripsiproduk');
        $product->gambar = request()->file('formFile')->store('images', 'public');
        $product->save();
        if ($product) {
            Session::flash('success','Sukses Tambah Data'); 
            return redirect()->route('products.index');
        } else {
            Session::flash('success','Failed Tambah Data');
            return redirect()->route('products.index');
        }
        // var_dump(Request('namaproduk'));
        // var_dump(Request('deskripsiproduk'));
        // var_dump(Request('formFile'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Products::find($id);
        return view('products.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::find($id);
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Products::find($id);

        // jika file image tersebut telah tersedia, maka file yang lama akan dihapus
        if ( $product->gambar && file_exists(storage_path('app/public/' . $product->gambar))) 
        {
            \Storage::delete(['public/' .$product->gambar]);
        }
        // namun, jika file image masih belum ada, maka file baru yang diupload akan disimpan
        $image_name = $request->file('formFile')->store('images', 'public');
        $product->gambar = $image_name;
        $product->nama = request('namaproduk');
        $product->deskripsi= request('deskripsiproduk');
        $product->save();

           if ($product) {
            Session::flash('success','Sukses Update Data');
                return redirect()->route('products.index');
            } else {
                Session::flash('success','Failed Update Data');
                return redirect()->route('products.index');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Products::find($id)->delete();
        return redirect()->route('products.index')
            -> with('success', 'Produk Berhasil Dihapus');
    }
}
