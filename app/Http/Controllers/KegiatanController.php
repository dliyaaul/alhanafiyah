<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class KegiatanController extends Controller
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
        if ($request->has('search')) {
            $kegiatan = Kegiatan::where('keterangan', 'LIKE', '%' . $request->search . '%')->latest()->paginate(5);
        } else {
            $kegiatan = Kegiatan::latest()->paginate(5);
        }

        return view('alhanafiyah/kegiatan', compact('kegiatan'));
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
            'required' => ':attribute Belum Ada!',
            'max' => ':attribute Maksimal :max Karakter',
            'mimes' => ':attribute Format Harus jpg/jpeg/png'
        ];

        //validasi form
        $this->validate($request, [
            'tanggal' => 'required',
            'tempat' => 'required|max:50',
            'keterangan' => 'required|max:150',
            'gambar' => 'mimes:png,jpg,jpeg',
        ], $message);

        //ambil parameter
        $file = $request->file('gambar');

        //rename
        $nama_file = time() . "_" . $file->getClientOriginalName();

        //proses upload
        $tujuan_upload = './admin/img/';
        $file->move($tujuan_upload, $nama_file);

        //insert data

        Kegiatan::create([
            'tanggal' => $request->tanggal,
            'tempat' => $request->tempat,
            'keterangan' => $request->keterangan,
            'gambar' => $nama_file
        ]);

        Session::flash('createKegiatan', 'Create Data Kegiatan Success!');
        return redirect('kegiatan')->with('gambar', $nama_file);
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
        $message = [
            'required' => ':attribute Belum Ada!',
            'max' => ':attribute Maksimal :max Karakter',
            'mimes' => ':attribute Format Harus jpg/jpeg/png'
        ];

        //validasi form
        $this->validate($request, [
            'tanggal' => 'required',
            'tempat' => 'required|max:50',
            'keterangan' => 'required|max:150',
            'gambar' => 'mimes:png,jpg,jpeg',
        ], $message);

        $kegiatan = Kegiatan::find($id);
        file::delete('./admin/img/' . $kegiatan->gambar);

        //ambil parameter
        $file = $request->file('gambar');

        //rename
        $nama_file = time() . "_" . $file->getClientOriginalName();

        //proses upload
        $tujuan_upload = './admin/img/';
        $file->move($tujuan_upload, $nama_file);

        //menyimpan ke database
        $kegiatan->tanggal = $request->tanggal;
        $kegiatan->tempat = $request->tempat;
        $kegiatan->keterangan = $request->keterangan;
        $kegiatan->gambar = $nama_file;
        $kegiatan->save();
        Session::flash('editKegiatan', 'Edit Data Kegiatan Success!');
        return redirect('/kegiatan')->with('gambar', $nama_file);
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
        $kegiatan = Kegiatan::find($id);
        $kegiatan->delete();
        Session::flash('deleteKegiatan', 'Delete Data Kegiatan Success!');
        return redirect('/kegiatan');
    }
}
