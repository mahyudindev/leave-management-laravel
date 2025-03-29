<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Departemen;
use App\Models\Jabatan;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::select('users.*', 'departemen.nama as departemen_nama', 'jabatan.nama as jabatan_nama')
            ->leftJoin('departemen', 'users.departemen_id', '=', 'departemen.id')
            ->leftJoin('jabatan', 'users.jabatan_id', '=', 'jabatan.id')
            ->when($request->input('nama'), function ($query, $nama) {
                $query->where('users.name', 'like', '%' . $nama . '%');
            })
            ->paginate(10);

        return view('admin.user.user', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully');
    }

    public function edit($id)
    {
        $user = User::select('users.*', 'departemen.nama as departemen_nama', 'jabatan.nama as jabatan_nama')
            ->leftJoin('departemen', 'users.departemen_id', '=', 'departemen.id')
            ->leftJoin('jabatan', 'users.jabatan_id', '=', 'jabatan.id')
            ->where('users.id', $id)
            ->first();

        if (!$user) {
            return redirect()->route('admin.user.index')->with('error', 'User not found');
        }

        $departemens = Departemen::all();
        $jabatans = Jabatan::all();
        return view('admin.user.edit-user', compact('user', 'departemens', 'jabatans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|string|max:10|unique:users,nik,' . $id,
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:30|unique:users,email,' . $id,
            'password' => 'nullable|string|max:70',
            'tanggal_masuk_kerja' => 'nullable|date',
            'tanggal_akhir_kerja' => 'nullable|date|after_or_equal:tanggal_masuk_kerja',
            'jumlah_cuti' => 'required|string|max:2',
            'departemen_id' => 'nullable|exists:departemen,id',
            'jabatan_id' => 'nullable|exists:jabatan,id',
            'role' => 'required|in:hrd,manager,pegawai',
        ]);

        $user = User::findOrFail($id);

        $data = [
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'tanggal_masuk_kerja' => $request->tanggal_masuk_kerja,
            'tanggal_akhir_kerja' => $request->tanggal_akhir_kerja,
            'jumlah_cuti' => $request->jumlah_cuti,
            'departemen_id' => $request->departemen_id,
            'jabatan_id' => $request->jabatan_id,
            'role' => $request->role,
            'updated_at' => now(),
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully');
    }

    public function create()
    {
        $departemens = Departemen::all();
        $jabatans = Jabatan::all();
        return view('admin.user.create-user', compact('departemens', 'jabatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:10|unique:users,nik',
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:30|unique:users,email',
            'password' => 'required|string|max:70',
            'tanggal_masuk_kerja' => 'required|date',
            'tanggal_akhir_kerja' => 'nullable|date|after_or_equal:tanggal_masuk_kerja',
            'jumlah_cuti' => 'required|string|max:2',
            'departemen_id' => 'nullable|exists:departemen,id',
            'jabatan_id' => 'nullable|exists:jabatan,id',
            'role' => 'required|in:hrd,manager,pegawai',
        ]);

        User::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tanggal_masuk_kerja' => $request->tanggal_masuk_kerja,
            'tanggal_akhir_kerja' => $request->tanggal_akhir_kerja,
            'jumlah_cuti' => $request->jumlah_cuti,
            'departemen_id' => $request->departemen_id,
            'jabatan_id' => $request->jabatan_id,
            'role' => $request->role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User created successfully');
    }

    public function export(Request $request)
    {
        $departemenId = $request->input('departemen_id');
        $departemen = $departemenId ? Departemen::find($departemenId) : null;
        $filename = 'Data_Karyawan_' . ($departemen ? $departemen->nama . '_' : '') . now()->format('d-m-Y') . '.xlsx';
        
        return Excel::download(new UsersExport($departemenId), $filename);
    }
}
