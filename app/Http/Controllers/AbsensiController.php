<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Tausiyah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller {
    public function index() 
    {
        // Ambil semua absensi dengan relasi umat
        $absensis = Absensi::with('tausiyah')->get();
        return view('absensis.index', compact('absensis'));
    }

    public function create()
    {
        // Ambil semua data umat untuk dropdown pilihan
        $tausiyahs = Tausiyah::all();
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
        return view('absensis.edit', compact('absensi', 'tausiyahs'));
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
