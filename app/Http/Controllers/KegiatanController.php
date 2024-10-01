<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('backend/kegiatan');
    }

    public function getData(Request $request)
    {
        // Ambil data dari database
        $data = Kegiatan::all();

        // Kembalikan data dalam format JSON
        return response()->json(['data' => $data]);
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
            'keterangan' => 'required|max:50',
            'tempat' => 'required|max:30',
            'tanggal' => 'required',
            'gambar' => 'required|image|mimes:png,jpg,jpeg|max:1024',
        ], $message);

        //ambil parameter
        $file = $request->file('gambar');

        //rename
        $nama_file = time() . "_" . $file->getClientOriginalName();

        //proses upload
        $tujuan_upload = 'public/img/kegiatan/';
        $filePath = $file->storeAs($tujuan_upload, $nama_file);

        //insert data

        $kegiatan = Kegiatan::create([
            'keterangan' => $request->keterangan,
            'tempat' => $request->tempat,
            'tanggal' => $request->tanggal,
            'gambar' => $nama_file
        ]);

        $kegiatan->save();

        return response()->json($kegiatan);
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
            'keterangan' => 'required|max:50',
            'tempat' => 'required|max:30',
            'tanggal' => 'required',
            'gambar' => 'required|image|mimes:png,jpg,jpeg|max:1024',
        ], $message);

        // Ambil data donasi
        $kegiatan = Kegiatan::findOrFail($request->id);
        if (!$kegiatan) {
            return response()->json(['error' => 'kegiatan not found'], 404);
        }

        if ($request->hasFile('gambar')) {
            // Hapus file lama jika ada
            if ($kegiatan->gambar) {
                // Hapus gambar dari storage jika ada
                if (Storage::exists('public/img/kegiatan/' . $kegiatan->gambar)) {
                    Storage::delete('public/img/kegiatan/' . $kegiatan->gambar);
                }
            }

            // Simpan file baru
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/img/kegiatan/', $nama_file);
            $kegiatan->gambar = $nama_file;
        }

        $kegiatan->keterangan = $request->keterangan;
        $kegiatan->tempat = $request->tempat;
        $kegiatan->tanggal = $request->tanggal;

        $kegiatan->save();

        return response()->json($kegiatan);
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
        $kegiatan = Kegiatan::findOrFail($id);

        // Periksa apakah kegiatan memiliki gambar yang disimpan
        if ($kegiatan->gambar) {
            // Hapus gambar dari storage jika ada
            if (Storage::exists('public/img/kegiatan/' . $kegiatan->gambar)) {
                Storage::delete('public/img/kegiatan/' . $kegiatan->gambar);
            }
        }

        $kegiatan->delete();

        return response()->json(['message' => 'kegiatan deleted successfully']);
    }
}
