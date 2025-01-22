<?php

namespace App\Http\Controllers;

use App\Models\JenisCuti;
use Illuminate\Http\Request;

class JenisCutiController extends Controller
{
    public function index()
    {
        $jenisCuti = JenisCuti::paginate(10);
        return view('admin.jenis_cuti.index', compact('jenisCuti'));
    }

    public function create()
    {
        return view('admin.jenis_cuti.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_cuti' => 'required|string|max:50|unique:jenis_cuti,nama_cuti',
        ]);

        JenisCuti::create($request->only('nama_cuti'));

        return redirect()->route('admin.jenis_cuti.index')->with('success', 'Jenis Cuti berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jenisCuti = JenisCuti::findOrFail($id);
        return view('admin.jenis_cuti.edit', compact('jenisCuti'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_cuti' => 'required|string|max:50|unique:jenis_cuti,nama_cuti,' . $id,
        ]);

        $jenisCuti = JenisCuti::findOrFail($id);
        $jenisCuti->update($request->only('nama_cuti'));

        return redirect()->route('admin.jenis_cuti.index')->with('success', 'Jenis Cuti berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenisCuti = JenisCuti::findOrFail($id);
        $jenisCuti->delete();

        return redirect()->route('admin.jenis_cuti.index')->with('success', 'Jenis Cuti berhasil dihapus.');
    }
}
