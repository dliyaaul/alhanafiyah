<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

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
        if ($request->has('search')) {
            $profile = Profile::where('judul', 'LIKE', '%' . $request->search . '%')->latest()->paginate(5);
        } else {
            $profile = Profile::latest()->paginate(5);
        }
        return view('alhanafiyah/profile', compact('profile'));
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
            'logo' => 'mimes:png,jpg,jpeg',
        ], $message);

        //ambil parameter
        $file = $request->file('logo');

        //rename
        $nama_file = time() . "_" . $file->getClientOriginalName();

        //proses upload
        $tujuan_upload = './admin/img/';
        $file->move($tujuan_upload, $nama_file);

        //insert data

        Profile::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'logo' => $nama_file
        ]);

        Session::flash('createProfile', 'Create Data Profile Success!');
        return redirect('profile')->with('logo', $nama_file);
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
            'logo' => 'mimes:png,jpg,jpeg',
        ], $message);

        $profile = Profile::find($id);
        file::delete('./admin/img/' . $profile->logo);

        //ambil parameter
        $file = $request->file('logo');

        //rename
        $nama_file = time() . "_" . $file->getClientOriginalName();

        //proses upload
        $tujuan_upload = './admin/img/';
        $file->move($tujuan_upload, $nama_file);

        //menyimpan ke database
        $profile->judul = $request->judul;
        $profile->isi = $request->isi;
        $profile->logo = $nama_file;
        $profile->save();
        Session::flash('editProfile', 'Edit Data Profile Success!');
        return redirect('/profile')->with('logo', $nama_file);
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
        $profile = Profile::find($id);
        $profile->delete();
        Session::flash('deleteProfile', 'Delete Data Profile Success!');
        return redirect('/profile');
    }
}
