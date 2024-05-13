<?php

namespace App\Http\Controllers;

use App\Models\Beranda;
use App\Models\Gambar;
use App\Models\Kegiatan;
use App\Models\Pengumuman;
use App\Models\Profile;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beranda = Beranda::all();
        $profile = Profile::all();
        $kegiatan = Kegiatan::all();
        $pengumuman = Pengumuman::latest()->paginate(6);
        $gambar = Gambar::all();

        return view('welcome', compact('beranda', 'profile', 'kegiatan', 'pengumuman', 'gambar'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $view = Kegiatan::find($id);

        return view('view_kegiatan', compact('view'));
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
}
