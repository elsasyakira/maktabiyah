<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umat;

class UmatController extends Controller
{
    public function index()
    {
        $umats = Umat::all();
        return view('umats.index', compact('umats')); // Pastikan file view ini ada
    }

    public function create()
    {
        return view('umats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nas' => 'required|integer',
            'syubah' => 'required|string',
            'farah' => 'required|integer',
            'holaqoh' => 'required|integer',
        ]);

        Umat::create([
            'name' => $request->name,
            'nas' => $request->nas,
            'syubah' => $request->syubah,
            'farah' => $request->farah,
            'holaqoh' => $request->holaqoh,
        ]);

        return redirect()->route('umats.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $umat = Umat::findOrFail($id);
        return view('umats.edit', compact('umat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nas' => 'required|string|max:10',
            'syubah' => 'required|string',
            'farah' => 'required|integer',
            'holaqoh' => 'required|string|max:10',
        ]);

        $umat = Umat::findOrFail($id);
        
        $umat->update([
            'name' => $request->name,
            'nas' => $request->nas,
            'syubah' => $request->syubah,
            'farah' => $request->farah,
            'holaqoh' => $request->holaqoh,
        ]);

        return redirect()->route('umats.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Umat::destroy($id);
        return redirect()->route('umats.index')->with('success', 'Data berhasil dihapus!');
    }
}
