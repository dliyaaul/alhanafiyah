<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
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
        return view('backend/profile');
    }

    public function getData(Request $request)
    {
        // Ambil data dari database
        $data = Profile::all();

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
            'judul' => 'required|max:30',
            'isi' => 'required|max:100',
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:1024',
        ], $message);

        //ambil parameter
        $file = $request->file('logo');

        //rename
        $nama_file = time() . "_" . $file->getClientOriginalName();

        //proses upload
        $tujuan_upload = 'public/img/profile/';
        $filePath = $file->storeAs($tujuan_upload, $nama_file);

        //insert data

        $profile = Profile::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'logo' => $nama_file
        ]);

        $profile->save();

        return response()->json($profile);
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
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:1024', // Gambar tidak wajib diubah
        ], $message);

        // Ambil data donasi
        $profile = Profile::findOrFail($request->id);
        if (!$profile) {
            return response()->json(['error' => 'Profile not found'], 404);
        }

        if ($request->hasFile('logo')) {
            // Hapus file lama jika ada
            if ($profile->logo) {
                Storage::delete('public/img/profile/' . $profile->logo);
            }

            // Simpan file baru
            $file = $request->file('logo');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/img/profile/', $nama_file);
            $profile->logo = $nama_file;
        }

        $profile->judul = $request->judul;
        $profile->isi = $request->isi;

        $profile->save();

        return response()->json($profile);
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
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return response()->json(['message' => 'Profile deleted successfully']);
    }
}
