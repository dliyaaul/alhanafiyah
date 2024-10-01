<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beranda;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
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
        $beranda = Beranda::all();
        return view('backend/dashboard', compact('beranda'));
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

        // Validasi form
        $this->validate($request, [
            'judul' => 'required|max:30',
            'isi' => 'required|max:100',
            'gambar' => 'required|image|mimes:png,jpg,jpeg|max:1024',
        ], $message);

        // Ambil parameter
        $file = $request->file('gambar');

        // Rename file
        $nama_file = time() . "_" . $file->getClientOriginalName();

        // Proses upload ke storage
        $tujuan_upload = 'public/img';
        $filePath = $file->storeAs($tujuan_upload, $nama_file);

        // Insert data
        Beranda::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $nama_file
        ]);

        Session::flash('success', 'Create Data Dashboard Success!');
        return redirect('dashboard')->with('gambar', $nama_file);
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

        // Validasi form
        $this->validate($request, [
            'judul' => 'required|max:30',
            'isi' => 'required|max:100',
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg|max:1024', // Gambar tidak wajib diubah
        ], $message);

        // Ambil data donasi
        $beranda = Beranda::find($id);
        $beranda->judul = $request->judul;
        $beranda->isi = $request->isi;

        if ($request->hasFile('gambar')) {
            // Hapus file lama jika ada
            if ($beranda->gambar) {
                Storage::delete('public/img/' . $beranda->gambar);
            }

            // Simpan file baru
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/img', $nama_file);
            $beranda->gambar = $nama_file;
        }

        $beranda->save();

        Session::flash('success', 'Update Data Dashboard Success!');
        return redirect('dashboard')->with('gambar', $beranda->gambar);
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
        $beranda = Beranda::findOrFail($id);
        $beranda->delete();

        return response()->json(['success' => true]);
    }
}
