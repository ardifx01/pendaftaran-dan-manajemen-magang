<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Devisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileMahasiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('mahasiswa.profile.index', [
            "title" => "My Profile",
            "mahasiswa" => $user->mahasiswa,
        ]);
    }

    public function edit(Admin $admin)
    {
        $user = Auth::user();

        return view('admin.profile.edit', [
            "title" => "Edit Admin",
            "admin" => $admin,
            "devisi" => Devisi::all(),
        ]);
    }

    public function update(Request $request)
    {
        $admin = auth()->user()->admin;
        $user = User::where('admin_id', $admin->nip)->first();

        // Pastikan $admin adalah instance Admin sebelum melanjutkan
        if (!$admin instanceof Admin) {
            return redirect('/admin/profile')->with('error', 'Data admin tidak ditemukan.');
        }

        $rules = [
            'nip' => 'required',
            'devisi_id' => 'required',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|max:15',
            'email' => 'required|email',
            'image' => 'nullable|image',
        ];


        $request->validate($rules);

        // Update di user juga jika nama dan email diubah
        if ($request->nama != $admin->nama || $request->email != $admin->email || $request->nip != $admin->nip) {
            $userUpdateData = [
                'name' => $request->nama,
                'email' => $request->email,
                'admin_id' => $request->nip,
            ];

            if ($user) {
                $user->update($userUpdateData);
            }
        }


        // Update data admin menggunakan instance model
        $admin->update([
            'devisi_id' => $request->devisi_id,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'image' => $request->file('image') ? $request->file('image')->store('mahasiswa-images') : null,
        ]);

        return redirect('/admin/profile')->with('success', 'Data ' . $admin->nama . ' berhasil diubah!');
    }

    public function destroy(Admin $admin)
    {
        $admin->user->delete(); // Hapus terlebih dahulu user yang terkait
        $admin->delete(); // Hapus admin setelah user dihapus

        return redirect('/login')->with('success', 'Data admin berhasil dihapus!');
    }
}
