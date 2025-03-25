<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umat;
use App\Models\Tausiyah;
use Illuminate\Support\Facades\DB;

class TausiyahController extends Controller
{
    public function index()
    {
        $tausiyahs = Tausiyah::with('umat')->get(); // Ambil semua data tausiyah dengan relasi umat
        $menuTausiyah = 'active';
        return view('tausiyahs.index', compact('tausiyahs','menuTausiyah'));
    }

    public function create()
    {
        $user = auth()->user(); // Ambil user yang login

        if ($user->role === 'admin') {
            // Admin bisa melihat semua umat
            $umatList = Umat::all();
        } else {
            // Mudir hanya bisa melihat umat dengan syubah yang sama
            $umatList = Umat::where('syubah', $user->syubah)->get();
        }

        return view('tausiyahs.create', compact('umatList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'umat_id' => 'required|exists:umats,id',
        ]);
    
        DB::table('tausiyahs')->insert([
            'umat_id' => $request->umat_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->route('tausiyahs.create')->with('success', 'Anggota halaqoh berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tausiyah = Tausiyah::findOrFail($id); // Pastikan variabel ini ada
        $umats = Umat::all();
        $menuTausiyah = 'active';
        return view('tausiyahs.edit', compact('tausiyah', 'umats','menuTausiyah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'umat_id' => 'required|exists:umats,id',
        ]);

        $tausiyah = Tausiyah::findOrFail($id);
        $umat = Umat::find($request->umat_id);

        $tausiyah->update([
            'umat_id' => $umat->id,
            'name' => $umat->name,
            'holaqoh' => $umat->holaqoh ?? 'Tanpa Halaqoh',
        ]);

        return redirect()->route('tausiyahs.index')->with('success', 'Tausiyah berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Tausiyah::findOrFail($id)->delete();
        return redirect()->route('tausiyahs.index')->with('success', 'Tausiyah berhasil dihapus!');
    }

    public function getUmat($id)
    {
        $umat = Umat::findOrFail($id);
        return response()->json([
            'name' => $umat->name,
            'holaqoh' => $umat->holaqoh,
        ]);
    }
}
