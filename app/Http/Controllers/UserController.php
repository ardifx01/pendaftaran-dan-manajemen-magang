<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Mahasiswa;
use \App\Models\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;



class UserController extends Controller
{


    public function index(){

        return view('users.index',[
            "title" => "USERS",
             "users" => User::latest()->filter(request(['search']))->paginate(5),
            
        ]);   
    }

    // show

    public function show(User $user):view{

        return view('users.show',[

            "user" => $user,
            "title" => "Tambah User"
        ]);
    }

    // ----------------------------------------------


      // create
    public function createAdmin(User $user):view{

        return view('users.create.admin',[

            "title" => "Tambah User Admin",
            "user" => $user
        ]);
    }

    public function createMahasiswa():view{

        return view('users.create.mahasiswa',[

            "title" => "Tambah User Mahasiswa"
        ]);
    }
    // ----------------------------------------------


    // edit
    public function edit(User $user){

        return view('users.edit',[

            "title" => "Edit Admin",
            "user" => $user
        ]);
    }

    public function editMahasiswa(User $user){

        return view('users.edit.mahasiswa',[

            "title" => "Edit Mahasiswa",
            "user" => $user
        ]);
    }

    // ---------------------------
  

    

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'mahasiswa_id' => 'nullable|numeric',
            'admin_id' => 'nullable|numeric',
            'role' => ['required', Rule::in(['mahasiswa', 'admin'])],
            'password' => 'required|min:8',
        ],
        [
            'nim_nisn.required' => 'Nim/nisn tidak boleh kosong',
            'nip.required' => 'Nip tidak boleh kosong.',


        ]);

        if (!empty($validatedData['mahasiswa_id'])) {
            $existsMahasiswa = Mahasiswa::where('nim_nisn', $validatedData['mahasiswa_id'])->exists();   
            if (!$existsMahasiswa) {
                return redirect()->route('users.mahasiswa.create')->withErrors(['mahasiswa_id' => 'Mahasiswa/Siswa dengan NIM/NISN '. $validatedData['mahasiswa_id'] . ' tidak ditemukan.']);
            }     
        }

        if (!empty($validatedData['admin_id'])) {
            $existsAdmin = Admin::where('nip', $validatedData['admin_id'])->exists();
        
            if (!$existsAdmin) {
                return redirect()->route('users.admin.create')->withErrors(['admin_id' =>'Admin (Pegawai) Dengan NIP '. $validatedData['admin_id'] . ' tidak ditemukan.']);
            }
        }
        
        

        
        if (!empty($validatedData['mahasiswa_id'])) {
            $mahasiswa = Mahasiswa::findOrFail($validatedData['mahasiswa_id']);
            $validatedData['name'] = $mahasiswa->nama;
            $validatedData['email'] = $mahasiswa->email;
        }

        if (!empty($validatedData['admin_id'])) {
            $admin = Admin::findOrFail($validatedData['admin_id']);
            $validatedData['name'] = $admin->nama;
            $validatedData['email'] = $admin->email;
        }

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');

        if (User::create($validatedData)) {
            return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
        } else {
            if (!empty($validatedData['admin_id'])) {
                return redirect()->route('users.index')->withErrors(['admin_id' => 'Data admin dengan ID tersebut tidak ditemukan.']);
            } elseif (!empty($validatedData['mahasiswa_id'])) {
                return redirect()->route('users.index')->withErrors(['mahasiswa_id' => 'Data mahasiswa dengan ID tersebut tidak ditemukan.']);
            }
        }
    }
    




//   public function update(Request $request, User $user)
// {
//     $rules = [
//         'role' => ['required', Rule::in(['mahasiswa', 'admin'])],
//         'name' => 'required|string|max:255',
//     ];

//     if ($request->email != $user->email) {
//         $rules['email'] = 'required|email|unique:users,email';
//     }


//     $validatedData = $request->validate($rules);


//     User::where('id', $user->id)
//         ->update($validatedData);

//     return redirect('/admin/users')->with('success', 'Data User berhasil diubah!');
// }



    public function editPassword(User $user)
    {
        return view('users.editPassword', [
            "title" => "Edit Password",
            "user" => $user
        ]);
    }
    
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);
    
        $user->update([
            'password' => Hash::make($request->password),
        ]);
    
        return redirect()->route('users.index')->with('success', 'Password berhasil diubah!');
    }
    
    

    public function destroy(User $user){
        User::destroy($user->id);
        return redirect()->route('users.index')->with('success', 'Data berhasil di hapus');
    }

    
}