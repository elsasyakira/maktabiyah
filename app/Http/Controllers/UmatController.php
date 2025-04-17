<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umat;

class UmatController extends Controller
{
    public function index(Request $request)
    {
        $query = Umat::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $data = [
            "umats" => Umat::all(),
            "totalUmat" => Umat::count(),
            "title" => "Data Umat",
            "menuAdminUmat" => "active",
        ];
        
        return view('umats.index', $data);
    }

    public function create()
    {
        $menuAdminUmat = 'active';
        return view('umats.create', compact('menuAdminUmat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nas' => 'required|string|max:10|unique:umats,nas',
            'syubah' => 'required|string',
            'farah' => 'required|integer',
            'holaqoh' => 'required|string|max:50',
        ], [
            'nas.unique' => 'NAS sudah terdaftar, silakan gunakan yang lain.',
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
        $menuAdminUmat = 'active';
        return view('umats.edit', compact('umat','menuAdminUmat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nas' => 'required|string|max:10|unique:umats,nas,' . $id,
            'syubah' => 'required|string',
            'farah' => 'required|integer',
            'holaqoh' => 'required|string|max:10',
        ], [
            'nas.unique' => 'NAS sudah terdaftar, silakan gunakan yang lain.',
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
