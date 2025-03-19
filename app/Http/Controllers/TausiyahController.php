<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umat;
use App\Models\Tausiyah;

class TausiyahController extends Controller
{
    public function index()
    {
        $tausiyahs = Tausiyah::with('umat')->get(); // Ambil semua data tausiyah dengan relasi umat
        return view('tausiyahs.index', compact('tausiyahs'));
    }

    public function create()
    {
        $umats = Umat::all(); // Ambil semua data umat
        return view('tausiyahs.create', compact('umats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'umat_id' => 'required|exists:umats,id',
        ]);

        // Ambil data umat berdasarkan umat_id
        $umat = Umat::find($request->umat_id);

        // Simpan ke database
        Tausiyah::create([
            'umat_id' => $umat->id,
            'name' => $umat->name, // Simpan nama dari tabel umats
            'holaqoh' => $umat->holaqoh, // Simpan halaqoh dari tabel umats
        ]);

        return redirect()->route('tausiyahs.index')->with('success', 'Tausiyah berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tausiyah = Tausiyah::findOrFail($id); // Pastikan variabel ini ada
        $umats = Umat::all();
        return view('tausiyahs.edit', compact('tausiyah', 'umats'));
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
