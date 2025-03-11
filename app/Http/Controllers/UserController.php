<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan daftar user
    public function index()
    {
        $users = User::all();
        return view('user.user', compact('users'));
    }

    // Menampilkan profil user yang sedang login
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }



    // Menyimpan user baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,jamiah,syubah,mudir',
            'syubah' => 'required|in:AshShidiqqin,AsySyuhada,AshSholihin,AlMutaqien,AlMuhsinin,AshShobirin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'syubah' => $request->syubah,
        ]);

        return redirect()->route('user')->with('success', 'User berhasil ditambahkan.');
    }






    // Menampilkan form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    // Memperbarui data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,jamiah,syubah,mudir',
            'syubah' => 'required|in:AshShidiqqin,AsySyuhada,AshSholihin,AlMutaqien,AlMuhsinin,AshShobirin',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role,
            'syubah' => $request->syubah,
        ]);

        return redirect()->route('user')->with('success', 'User berhasil diperbarui.');
    }

    // Menghapus user dari database
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user')->with('success', 'User berhasil dihapus.');
    }
}
