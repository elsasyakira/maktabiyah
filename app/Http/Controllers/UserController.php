<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\User; // Impor model User

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all(); // Ambil semua data user
        return view('user.user', compact('users')); // Kirim data ke view
    }

    public function profile()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        return view('user.profile', compact('user'));
    }
}
