<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
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
        $data = array(
            "title" => "Data User",
            "menuAdminUser" => "active",
            "users"  => User::OrderBy('role','asc')->paginate(10),
        );
        return view('user.index', $data);
    }

    // Menampilkan profil user yang sedang login
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function create()
    {
        $data = array(
            "title" => "Tambah User",
            "menuAdminUser" => "active",
            "user"  => User::get(),
        );
        return view ('user.create', $data);
    }

    // Menyimpan user baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'syubah' => 'required',
            'password' => 'required|confirmed|min:8',
        ],[
                'name.required'         => 'Nama tidak boleh kosong',
                'email.required'        => 'Email tidak boleh kosong',
                'email.unique'          => 'Email sudah terdaftar',
                'role.required'        => 'Role tidak boleh kosong',
                'syubah.required'        => 'Syubah tidak boleh kosong',
                'password.required'     => 'Password tidak boleh kosong',
                'password.confirmed'    => 'Password konfirmasi tidak sama',
                'password.min'  => 'Password minimal 8 karakter',
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
        $data = array(
            "title" => "Edit User",
            "menuAdminUser" => "active",
            "user"  => User::findOrFail($id),
        );

        return view('user.edit', $data); // Mengembalikan data dalam format JSON

    }

    // Memperbarui data user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'syubah' => 'required|string',
            'role' => 'required|string',
            'password' => 'nullable|min:8', // Password bisa kosong
        ],[
            'name.required'         => 'Nama tidak boleh kosong',
            'email.required'        => 'Email tidak boleh kosong',
            'email.unique'          => 'Email sudah terdaftar',
            'role.required'        => 'Role tidak boleh kosong',
            'syubah.required'        => 'Syubah tidak boleh kosong',
            'password.required'     => 'Password tidak boleh kosong',
            'password.confirmed'    => 'Password konfirmasi tidak sama',
            'password.min'  => 'Password minimal 8 karakter',
    ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->syubah = $request->syubah;
        $user->role = $request->role;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Hash password jika diisi
        }
        $user->save();
        return redirect()->route('user')->with('success', 'User berhasil diperbarui');
    }

    // Menghapus user dari database
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user')->with('success', 'User berhasil dihapus.');
    }

    public function pdf(){
        $filename = now()->format('d-m-Y_H.i.s');
        $data = array(
            'user' => User::OrderBy('role','asc')->get(),
            'tanggal' => now()->format('d-m-Y'),
            'jam' => now()->format('H.i.s'),
        );

        $pdf = Pdf::loadView('user.pdf', $data);
        return $pdf->setPaper('a4', 'landscape')->stream('DataUser_'.$filename.'.pdf');
    }
}
