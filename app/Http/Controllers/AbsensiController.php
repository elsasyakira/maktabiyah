<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Tausiyah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller {
    public function index() 
    {
        $absensis = Absensi::with('tausiyah')->get();
        $menuAbsensi = 'active';
        return view('absensis.index', compact('absensis','menuAbsensi'));
    }

    public function create()
    {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            $tausiyahs = Tausiyah::all();
        } else {
            $tausiyahs = Tausiyah::where('user_id', $user->id)->get();
        }
        $menuAbsensi = 'active';
        return view('absensis.create', compact('tausiyahs','menuAbsensi'));
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

        // Ambil data umat dari tabel Tausiyah
        $tausiyah = Tausiyah::find($request->umat_id);

        Absensi::create([
            'umat_id' => $request->umat_id,
            'status' => $request->status,
            'ket' => $request->ket,
            'pengisi' => $request->pengisi,
            'tempat' => $request->tempat,
            'bulan' => $request->bulan,
            'name' => $tausiyah ? $tausiyah->name : 'Tidak Diketahui', // Simpan nama umat dari Tausiyah
            'user_id' => auth()->id(), // Ambil ID user yang sedang login
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
