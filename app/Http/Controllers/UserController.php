<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Departemen;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = DB::table('users')
            ->select('users.*', 'departemen.nama as departemen_nama', 'jabatan.nama as jabatan_nama')
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
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            return redirect()->route('admin.user.index')->with('error', 'User not found');
        }

        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully');
    }

    public function edit($id)
    {
        $user = DB::table('users')
            ->select('users.*', 'departemen.nama as departemen_nama', 'jabatan.nama as jabatan_nama')
            ->leftJoin('departemen', 'users.departemen_id', '=', 'departemen.id')
            ->leftJoin('jabatan', 'users.jabatan_id', '=', 'jabatan.id')
            ->where('users.id', $id)
            ->first();

        if (!$user) {
            return redirect()->route('admin.user.index')->with('error', 'User not found');
        }

        $departemen = DB::table('departemen')->get();
        $jabatan = DB::table('jabatan')->get();

        return view('admin.user.edit-user', compact('user', 'departemen', 'jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|confirmed|min:8',
            'jumlah_cuti' => 'required|integer|min:0',
            'departemen_id' => 'nullable|exists:departemen,id',
            'jabatan_id' => 'nullable|exists:jabatan,id',
            'role' => 'required|in:user,admin',
        ]);

        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            return redirect()->route('admin.user.index')->with('error', 'User not found');
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'jumlah_cuti' => $request->jumlah_cuti,
            'departemen_id' => $request->departemen_id,
            'jabatan_id' => $request->jabatan_id,
            'role' => $request->role,
            'updated_at' => now(),
        ];

        // Jika password diisi, tambahkan ke data yang akan diupdate
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $id)->update($data);

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully');
    }

    public function create()
    {
        $departemen = DB::table('departemen')->get();
        $jabatan = DB::table('jabatan')->get();

        return view('admin.user.create-user', compact('departemen', 'jabatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:20|unique:users,nik',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|in:user,admin',
            'tanggal_masuk' => 'required|date',
            'jumlah_cuti' => 'required|integer|min:0',
            'departemen_id' => 'nullable|exists:departemen,id',
            'jabatan_id' => 'nullable|exists:jabatan,id',
        ]);

        DB::table('users')->insert([
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah_cuti' => $request->jumlah_cuti,
            'departemen_id' => $request->departemen_id,
            'jabatan_id' => $request->jabatan_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User created successfully');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'data_karyawan.xlsx');
    }
}
