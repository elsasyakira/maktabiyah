<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = array(
            "title" => "Dashboard",
            "menuDashboard" => "active",
            "jumlahAdmin" =>User::where('role', 'admin')->count(),
            "jumlahMudir" =>User::where('role', 'mudir')->count(),
            "jumlahJamiah" =>User::where('role', 'jamiah')->count(),
            "jumlahSyubah" =>User::where('role', 'syubah')->count(),
        );
        return view('dashboard', $data);
    }
    
}
