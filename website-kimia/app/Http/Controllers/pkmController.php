<?php

namespace App\Http\Controllers;

use App\Models\pkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class pkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = pkm::orderBy('id', 'asc')->get();
        return view('dashboard.pkm.index')->with('data', $data);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pkm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('judul', $request->judul);
        // Session::flash('isi', $request->isi);
        $request->validate(
            [
                'judul' =>'required',
                '_foto' => 'mimes:jpeg,jpg,png,gif',
            ],
            [
                'judul.required' => 'Judul wajib diisi',
                '_foto.mimes' => 'Foto yang dimasukkan hanya diperbolehkan berkestensi JPEG, JPG, PNG, dan GIF',
            ]
        );

        $foto_baru = NULL;
        if ($request->hasFile('_foto')) {
            $foto_file = $request->file('_foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_baru = date('ymdhis') . ".$foto_ekstensi";
            $foto_file->move(public_path('foto/pkm'), $foto_baru);
      
        }
        
        $data = [
            'judul' => $request->judul,
            'foto' => $foto_baru,
            'isi' => $request->isi,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
            'link' => $request->link
        ];
        pkm::create($data);

        return redirect()->route('pkm.index')->with('success', 'Berhasil menambahkan data');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = pkm::where('id', $id)->first();
        return view('dashboard.pkm.edit')->with('data', $data);
    
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
        $request->validate(
            [
                'judul' =>'required',
                '_foto' => 'mimes:jpeg,jpg,png,gif',
            ],
            [
                'judul.required' => 'Judul wajib diisi',
                '_foto.mimes' => 'Foto yang dimasukkan hanya diperbolehkan berkestensi JPEG, JPG, PNG, dan GIF',
            ]
        );


        $foto_baru = NULL;
        if ($request->hasFile('_foto')) {
            $foto_file = $request->file('_foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_baru = date('ymdhis') . ".$foto_ekstensi";
            $foto_file->move(public_path('foto/pkm'), $foto_baru);

            $data = pkm::where('id', $id)->first();
            $foto_lama = $data->foto;
            File::delete(public_path('foto/pkm') . "/" . $foto_lama);        
        }else {
            $data = pkm::where('id', $id)->first();
            $foto_baru = $data->foto;
        }
        $data = [
            'judul' => $request->judul,
            'foto' => $foto_baru,
            'isi' => $request->isi,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
            'link' => $request->link
        ];

        pkm::where('id', $id)->update($data);

        return redirect()->route('pkm.index')->with('success', 'Berhasil mengupdate data');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        pkm::where('id', $id)->delete();
        return redirect()->route('pkm.index')->with('success', 'Berhasil menghapus data');
    
    }
}
