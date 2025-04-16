<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Tausiyah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller {
    public function index() 
    {
        $user = auth()->user();

        if ($user->role === 'mudir') {
            $absensis = Absensi::with(['tausiyah.umat'])
                ->where('user_id', $user->id)
                ->get();
        } else {
            $absensis = Absensi::with(['tausiyah.umat'])->get();
        }

        $menuAbsensi = 'active';
        return view('absensis.index', compact('absensis','menuAbsensi'));
    }

    public function create()
    {
        $user = auth()->user();

        if ($user->role !== 'mudir') {
            abort(403);
        }

        $tausiyahs = Tausiyah::with('umat')
            ->where('user_id', $user->id)
            ->get();

        return view('absensis.create', compact('tausiyahs'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'umat_id' => 'required|exists:tausiyahs,id',
            'status' => 'required|in:hadir,izin,sakit,tanpa_keterangan',
            'ket' => 'nullable|string',
            'pengisi' => 'required|string',
            'tempat' => 'required|string',
            'bulan' => 'required|integer|between:1,12',
        ]);

        $user = auth()->user();

        $isOwned = Tausiyah::where('user_id', $user->id)
        ->where('id', $request->umat_id)
        ->exists();

        if (! $isOwned) {
            abort(403, 'Umat ini tidak terdaftar di data Anda.');
        }

        Absensi::create([
            'umat_id' => $request->umat_id,
            'status' => $request->status,
            'ket' => $request->ket,
            'pengisi' => $request->pengisi,
            'tempat' => $request->tempat,
            'bulan' => $request->bulan,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('absensis.index')->with('success', 'Absensi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $absensi = Absensi::findOrFail($id);
        $tausiyahs = Tausiyah::all();
        $menuAbsensi = 'active';
        return view('absensis.edit', compact('absensi', 'tausiyahs','menuAbsensi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'umat_id' => 'required|exists:tausiyahs,id',
            'status' => 'required|in:hadir,izin,sakit,tanpa_keterangan',
            'ket' => 'nullable|string',
            'pengisi' => 'required|string',
            'tempat' => 'required|string',
            'bulan' => 'required|integer|between:1,12',
        ]);

        $absensi = Absensi::findOrFail($id);
        
        // Ambil nama umat dari tabel Tausiyah
        $tausiyah = Tausiyah::find($request->umat_id);

        $absensi->update([
            'umat_id' => $request->umat_id,
            'status' => $request->status,
            'ket' => $request->ket,
            'pengisi' => $request->pengisi,
            'tempat' => $request->tempat,
            'bulan' => $request->bulan,
            'name' => $tausiyah ? $tausiyah->name : 'Tidak Diketahui', // Simpan nama umat dari Tausiyah
        ]);

        return redirect()->route('absensis.index')->with('success', 'Absensi berhasil diperbarui.');
    }

    public function destroy($id) 
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();
        return redirect()->route('absensis.index')->with('success', 'Absensi berhasil dihapus');
    }
}
