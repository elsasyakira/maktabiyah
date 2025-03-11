<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Umat;
use App\Models\User;
use Illuminate\Http\Request;

class AbsensiController extends Controller {
    public function index() {
        $absensi = Absensi::with('umat', 'user')->get();
        return view('absensis.index', compact('absensi'));
    }

    public function create() {
        $umats = Umat::all();
        $users = User::all();
        return view('absensis.create', compact('umats', 'users'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:hadir,izin,sakit,tanpa_keterangan',
            'ket' => 'nullable|string',
            'umat_id' => 'required|exists:umat,id',
            'user_id' => 'required|exists:users,id',
        ]);

        Absensi::create($request->all());

        return redirect()->route('absensis.index')->with('success', 'Absensi berhasil ditambahkan');
    }

    public function edit(Absensi $absensi) {
        $umats = Umat::all();
        $users = User::all();
        return view('absensis.edit', compact('absensi', 'umats', 'users'));
    }

    public function update(Request $request, Absensi $absensi) {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:hadir,izin,sakit,tanpa_keterangan',
            'ket' => 'nullable|string',
            'umat_id' => 'required|exists:umat,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $absensi->update($request->all());

        return redirect()->route('absensis.index')->with('success', 'Absensi berhasil diperbarui');
    }

    public function destroy(Absensi $absensi) {
        $absensi->delete();
        return redirect()->route('absensis.index')->with('success', 'Absensi berhasil dihapus');
    }
}
