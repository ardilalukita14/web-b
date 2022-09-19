<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian nama
            $mahasiswa = Mahasiswa::where('nama', 'like', "%" . $request->search . "%")->paginate(5);
        } else { // Jika tidak melakukan pencarian judul
            //fungsi eloquent menampilkan mahasiswa menggunakan pagination
            $mahasiswa = Mahasiswa::orderBy('user_id', 'desc')->paginate(5); // Pagination menampilkan 5 mahasiswa
        }
        return view('mahasiswa.index', compact('mahasiswa')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|alpha_dash|min:4|max:20|unique:App\Models\Mahasiswa',
            'nama' => 'required|string|max:50',
            'email' => 'required|string|max:50|unique:App\Models\Mahasiswa',
            'password' => 'required|alpha_dash|min:8|max:15|unique:App\Models\Mahasiswa',
            'berkas' => 'required|mimes:jpg,png|max:100'
        ];

        $validator =  Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('mahasiswa.index')->with('error', $validator->errors());
        }

        $file = $request->file('berkas');
        $image_name = '';
        if($file){
            $image_name = $file->store('images', 'public');
        }

        Mahasiswa::create([
            'username' => $request->input('username'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'avatar' => $image_name
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Mahasiswa::find($id);
        return view('mahasiswa.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data =  Mahasiswa::find($id);

        return (!$data)? view('no_data') :
                    view('mahasiswa.edit')
                    ->with('id', $id)
                    ->with('data', $data);
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
        $rules = [
            'username' => 'required|alpha_dash|min:4|max:20|unique:App\Models\Mahasiswa,user_id,'.$id,
            'nama' => 'required|string|max:50',
            'email' => 'required|string|max:50|unique:App\Models\Mahasiswa',
            'password' => 'required|alpha_dash|min:8|max:15|unique:App\Models\Mahasiswa',
            'berkas' => 'required|mimes:jpg,png|max:100'
        ];

        $validator =  Validator::make($request->all(), $rules);

        $data =  Mahasiswa::find($id);

        if($validator->fails()){
            return view('mahasiswa.edit')
                    ->with('error', $validator->errors())
                    ->with('id', $id)
                    ->with('data', $data);
        }

        $file = $request->file('berkas');
        $image_name = '';
        if($file){
            $image_name = $file->store('images', 'public');

            // if(Storage::exists('public/' . $data->avatar)){
            //     Storage::delete('public/' . $data->avatar);
            // }
        }

        Mahasiswa::where('user_id', $id)
                ->update([
                    'username' => $request->input('username'),
                    'nama' => $request->input('nama'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                    'avatar' => $image_name
                ]);


        return  view('mahasiswa.edit')
            ->with('id', $id)
            ->with('data', $data)
            ->with('success','Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mahasiswa::find($id)->delete();
        return redirect()->route('mahasiswa.index')
            -> with('success', 'Data Berhasil Dihapus');
    }

    public function cetak_pdf()
    {
        $data = Mahasiswa::all();
        
        //return view('cetak_pdf', ['data' => $data]);

        $pdf = Pdf::loadView('mahasiswa.cetak_pdf', ['data' => $data]);
        return $pdf->stream();
    }
}
