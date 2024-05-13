<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GambarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gambar = Gallery::latest()->get();
        return view('alhanafiyah/gambar', compact('gambar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute Tidak Boleh Kosong',
            'mimes' => ':attribute Format Harus jpg/jpeg/png'
        ];

        //validasi form
        $this->validate($request, [
            'id_gallery' => 'required',
            'gambar' => 'mimes:png,jpg,jpeg',
        ], $message);

        //ambil parameter
        $file = $request->file('gambar');

        //rename
        $nama_file = time() . "_" . $file->getClientOriginalName();

        //proses upload
        $tujuan_upload = './admin/img/';
        $file->move($tujuan_upload, $nama_file);

        //menyimpan ke database
        Gambar::create([
            'id_gallery' => $request->id_gallery,
            'gambar' => $nama_file,
        ]);
        Session::flash('uploadGambar', 'Upload Gambar Success!');
        return redirect('/gallery')->with('gambar', $nama_file);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        $gambar = Gambar::find($id);
        $gambar->delete();
        Session::flash('deleteGambar', 'Delete Gambar Success!');
        return redirect('gallery');
    }
}
