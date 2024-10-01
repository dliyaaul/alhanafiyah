<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PengumumanController extends Controller
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
        return view('backend/pengumuman');
    }

    public function getData(Request $request)
    {
        // Ambil data dari database
        $data = Pengumuman::all();

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
        ];

        //validasi form
        $this->validate($request, [
            'isi' => 'required|max:50',
            'judul' => 'required|max:30',
            'tanggal' => 'required',
        ], $message);

        //insert data
        $pengumuman = Pengumuman::create([
            'isi' => $request->isi,
            'judul' => $request->judul,
            'tanggal' => $request->tanggal
        ]);

        $pengumuman->save();

        return response()->json($pengumuman);
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
            'max' => ':attribute Maksimal :max Karakter'
        ];

        // Validasi form
        $this->validate($request, [
            'isi' => 'required|max:50',
            'judul' => 'required|max:30',
            'tanggal' => 'required',
        ], $message);

        // Ambil data donasi
        $pengumuman = Pengumuman::findOrFail($request->id);
        if (!$pengumuman) {
            return response()->json(['error' => 'Pengumuman not found'], 404);
        }

        $pengumuman->isi = $request->isi;
        $pengumuman->judul = $request->judul;
        $pengumuman->tanggal = $request->tanggal;

        $pengumuman->save();

        return response()->json($pengumuman);
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
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return response()->json(['message' => 'Pengumuman deleted successfully']);
    }
}
