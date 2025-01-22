<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    public function index()
    {
        $departemen = Departemen::paginate(10);
        return view('admin.departemen.index', compact('departemen'));
    }

    public function create()
    {
        return view('admin.departemen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50|unique:departemen,nama',
        ]);

        Departemen::create($request->only('nama'));

        return redirect()->route('admin.departemen.index')->with('success', 'Departemen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $departemen = Departemen::findOrFail($id);
        return view('admin.departemen.edit', compact('departemen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:50|unique:departemen,nama,' . $id,
        ]);

        $departemen = Departemen::findOrFail($id);
        $departemen->update($request->only('nama'));

        return redirect()->route('admin.departemen.index')->with('success', 'Departemen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $departemen = Departemen::findOrFail($id);
        $departemen->delete();

        return redirect()->route('admin.departemen.index')->with('success', 'Departemen berhasil dihapus.');
    }
}

