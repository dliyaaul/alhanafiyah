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
        if ($request->has('search')) {
            $pengumuman = Pengumuman::where('judul', 'LIKE', '%' . $request->search . '%')->latest()->paginate(5);
        } else {
            $pengumuman = Pengumuman::latest()->paginate(5);
        }

        return view('alhanafiyah/pengumuman', compact('pengumuman'));
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
            'tanggal' => 'required|max:30',
            'judul' => 'required|max:50',
            'isi' => 'required|max:100',
        ], $message);

        //insert data

        Pengumuman::create([
            'tanggal' => $request->tanggal,
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        Session::flash('createPengumuman', 'Create Data Pengumuman Success!');
        return redirect('pengumuman');
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
        ];

        //validasi form
        $this->validate($request, [
            'tanggal' => 'required|max:30',
            'judul' => 'required|max:50',
            'isi' => 'required|max:100',
        ], $message);

        $pengumuman = Pengumuman::find($id);
        //menyimpan ke database
        $pengumuman->tanggal = $request->tanggal;
        $pengumuman->judul = $request->judul;
        $pengumuman->isi = $request->isi;
        $pengumuman->save();
        Session::flash('editPengumuman', 'Edit Data Pengumuman Success!');
        return redirect('/pengumuman');
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
        $pengumuman = Pengumuman::find($id);
        $pengumuman->delete();
        Session::flash('deletePengumuman', 'Delete Data Pengumuman Success!');
        return redirect('/pengumuman');
    }
}
