<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beranda;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

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
        if ($request->has('search')) {
            $beranda = Beranda::where('judul', 'LIKE', '%' . $request->search . '%')->latest()->paginate(3);
        } else {
            $beranda = Beranda::latest()->paginate(3);
        }
        return view('alhanafiyah/dashboard', compact('beranda'));
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

        Beranda::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $nama_file
        ]);

        Session::flash('createDashboard', 'Create Data Dashboard Success!');
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

        //validasi form
        $this->validate($request, [
            'judul' => 'required|max:30',
            'isi' => 'required|max:100',
            'gambar' => 'mimes:png,jpg,jpeg',
        ], $message);

        $beranda = Beranda::find($id);
        file::delete('./admin/img/' . $beranda->gambar);

        //ambil parameter
        $file = $request->file('gambar');

        //rename
        $nama_file = time() . "_" . $file->getClientOriginalName();

        //proses upload
        $tujuan_upload = './admin/img/';
        $file->move($tujuan_upload, $nama_file);

        //menyimpan ke database
        $beranda->judul = $request->judul;
        $beranda->isi = $request->isi;
        $beranda->gambar = $nama_file;
        $beranda->save();
        Session::flash('editDashboard', 'Edit Data Dashboard Success!');
        return redirect('/dashboard')->with('gambar', $nama_file);
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
        $beranda = Beranda::find($id);
        $beranda->delete();
        Session::flash('deleteDashboard', 'Delete Data Dashboard Success!');
        return redirect('/dashboard');
    }
}
