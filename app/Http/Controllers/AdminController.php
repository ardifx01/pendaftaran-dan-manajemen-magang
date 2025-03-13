<?php

namespace App\Http\Controllers;


use App\Models\Admin;
use App\Models\Devisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class AdminController extends Controller
{

   

   public function index(){
    return view('admin.data-admin.index' , [
        "title" => "ADMIN",
        "admin" => Admin::latest()->filter(request(['search']))->paginate(5),
        
    ]);
}

public function show(Admin $admin){
return view('admin.data-admin.show' , [
    "title" => $admin->nama,
    "admin" => $admin
    

]);

}



public function create(){
  return view('admin.data-admin.create',[

    "devisi" => Devisi::all(),
    "title" => "TAMBAH DATA ADMIN"
  ]);
}

public function store(Request $request)
{

    

    $validatedData = $request->validate([
        'nip' => 'required',
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:admin,email',
        'alamat' => 'required|string',
        'no_telp' => 'required|string',
        'image' => 'image|nullable',
        'devisi_id' => 'required',
        
    ]);

    if($request->file('image')){
        $validatedData['image'] = $request->file('image')->store('admin-images'); 
    }

 
    Admin::create($validatedData);

    return redirect()->route('data-admin.index')->with('success', 'Data admin berhasil ditambahkan!');
}



public function edit(Admin $admin){

    return view('admin.data-admin.edit',[

        "title"=>"Edit $admin->nama",
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
    return redirect()->route('data-admin.show',$admin->nip)->with('success', 'Data Admin berhasil diedit!');
}



public function destroy(Admin $admin){

  
        if($admin->image){
            Storage::delete($admin->image);
        }
 
    Admin::destroy($admin->nip);
    return redirect()->route('data-admin.index')->with('success', 'Data admin berhasil di hapus!');
}


  

  
}

