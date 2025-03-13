<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Devisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('admin.profile.index', [
            "title" => "My Profile",
            "admin" => $user->admin,
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

    public function update(Request $request, Admin $admin)
    {
        $rules = [
            'nip' => 'required',
            'devisi_id' => 'required',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string',
            'image' => 'image|nullable',
    
        ];
    
      
      
        $validatedData = $request->validate($rules);
    
        if($request->file('image')){
    
            if($request->file('image')){
                if($request->oldImage){
                    Storage::delete($request->oldImage);
                }
            }
    
            $validatedData['image'] = $request->file('image')->store('admin-images'); 
        }
    
        // update di user juga jika nama dan email di ubah
    
        if ($request->nama != $admin->nama) {
            $validatedData['nama'] = $request->nama;
    
            if ($admin->user) {
                $admin->user->update(['name' => $request->nama]);
            }
        }
    
        if ($request->email != $admin->email) {
            $validatedData['email'] = $request->email;
    
            if ($admin->user) {
                $admin->user->update(['email' => $request->email]);
            }
        }
    
        if ($request->nip != $admin->nip) {
            $validatedData['nip'] = $request->nip;
    
            if ($admin->user) {
                $admin->user->update(['admin_id' => $request->nip]);
            }
        }
    
        if (!empty($validatedData['email'])) {
            $existsEmail = Admin::where('email', $validatedData['email'])->exists();
    
            if ($existsEmail) {
                return redirect()->route('data-admin.edit',$admin->nip)->withErrors(['email' => 'Email sudah digunakan oleh admin lain.']);
            }
        } 
    
        $admin->update($validatedData);
        return redirect()->route('profile.index')->with('success', 'Data Admin berhasil diedit!');
    }
    
    

    public function destroy(Admin $admin)
    {
        $admin->user->delete(); // Hapus terlebih dahulu user yang terkait
        $admin->delete(); // Hapus admin setelah user dihapus

        return redirect('/login')->with('success', 'Data admin berhasil dihapus!');
    }
}
