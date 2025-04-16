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
        $user = auth()->user();

        if ($user->role === 'admin') {
            // Admin bisa melihat semua data tausiyah
            $tausiyahs = \App\Models\Tausiyah::with('umat')->get();
        } else {
            // Mudir hanya bisa melihat data yang ia input sendiri
            $tausiyahs = \App\Models\Tausiyah::with('umat')
                            ->where('user_id', $user->id)
                            ->get();
        }

        return view('tausiyahs.index', compact('tausiyahs'));
    }


    public function create()
    {
        $user = auth()->user();
        $umatList = Umat::where('syubah', $user->syubah)->get();

        return view('tausiyahs.create', compact('umatList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'umat_id' => 'required|exists:umats,id',
        ]);
    
        $mudir = auth()->user();
    
        $umat = Umat::where('id', $request->umat_id)
                    ->where('syubah', $mudir->syubah)
                    ->firstOrFail();
    
        DB::table('tausiyahs')->insert([
            'umat_id' => $umat->id,
            'name' => $umat->name,
            'holaqoh' => $umat->holaqoh ?? 'Tanpa Halaqoh',
            'user_id' => $mudir->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);    
    
        return redirect()->route('tausiyahs.index')->with('success', 'Tausiyah berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tausiyah = Tausiyah::findOrFail($id);
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
