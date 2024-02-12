<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Page.timeline');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'foto' => 'required|image'
        ]);

        $nfile = $user->id . date('YmdHis') . '.' . $request->foto->getClientOriginalExtension();
        $request->foto->move(public_path('img'), $nfile);

        $data = [
            'id_user' => $user->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $nfile,
        ];

        Galery::create($data);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Galery $galery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galery $galery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galery $galery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galery $galery)
    {
        //
    }
}
