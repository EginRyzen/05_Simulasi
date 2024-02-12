<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $email = User::where('email', $request->email)->first();

        if ($email) {
            return back()->with('alert', 'Email Telah Terdaftar!!');
        }

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::create($data);

        Auth::login($user);

        return redirect('timeline');
    }

    public function login(Request $request)
    {
        $email = User::where('email', $request->email)->first();

        if (!$email) {
            return back()->with('alert', 'Email Belum Terdaftar');
        }

        if (!Hash::check($request->password, $email->password)) {
            return back()->with('alert', 'Password Yang Anda Masukan Salah!!');
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('timeline');
        } else {
            return back();
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
