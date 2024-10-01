<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SaldoWakaf;

class SaldoWakafController extends Controller
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
    public function index()
    {
        return view('backend/saldoWakaf');
    }

    public function getData(Request $request)
    {
        $data = SaldoWakaf::all();

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
            'min' => ':attribute Minimal :min Karakter',
        ];

        //validasi form
        $this->validate($request, [
            'keterangan' => 'required|max:100',
            'nama' => 'required|max:50',
            'penerima' => 'required|max:50',
            'jumlah' => 'required|max:100000000|min:1',
            'tanggal' => 'required',
        ], $message);

        //insert data
        $saldoWakaf = SaldoWakaf::create([
            'keterangan' => $request->keterangan,
            'nama' => $request->nama,
            'penerima' => $request->penerima,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal
        ]);

        $saldoWakaf->save();

        return response()->json($saldoWakaf);
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
            'min' => ':attribute Minimal :min Karakter',
        ];

        // Validasi form
        $this->validate($request, [
            'keterangan' => 'required|max:100',
            'nama' => 'required|max:50',
            'penerima' => 'required|max:50',
            'jumlah' => 'required|max:100000000|min:1',
            'tanggal' => 'required',
        ], $message);

        // Ambil data donasi
        $saldoWakaf = SaldoWakaf::findOrFail($request->id);
        if (!$saldoWakaf) {
            return response()->json(['error' => 'Saldo Wakaf not found'], 404);
        }

        $saldoWakaf->keterangan = $request->keterangan;
        $saldoWakaf->nama = $request->nama;
        $saldoWakaf->penerima = $request->penerima;
        $saldoWakaf->jumlah = $request->jumlah;
        $saldoWakaf->tanggal = $request->tanggal;

        $saldoWakaf->save();

        return response()->json($saldoWakaf);
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
        $saldoWakaf = SaldoWakaf::findOrFail($id);
        $saldoWakaf->delete();

        return response()->json(['message' => 'Saldo Wakaf deleted successfully']);
    }
}
