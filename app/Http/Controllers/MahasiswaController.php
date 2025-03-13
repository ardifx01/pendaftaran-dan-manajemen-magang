<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MahasiswaController extends Controller
{

   public function index(){

    return view('admin.mahasiswa.index' , [
        "title" => "MAHASISWA",
        "mahasiswa" => Mahasiswa::latest()->filter(request(['search']))->paginate(5),
        
    ]);
}

public function show(Mahasiswa $mahasiswa){
return view('admin.mahasiswa.show' , [
    "title" => $mahasiswa->nama,
    "mahasiswa" => $mahasiswa
]);

}



public function create(){
  return view('admin.mahasiswa.create',[

    "title" => "TAMBAH DATA MAHASISWA"
  ]);
}

public function store(Request $request)
{

    $validatedData = $request->validate([
        'nim_nisn' => 'required',
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:mahasiswa,email',
        'sekolah_univ' => 'required|string',
        'jurusan' => 'required|string',
        'alamat' => 'required|string',
        'no_telp' => 'required|string',
        'no_guru' => 'required|string',
        'image' => 'image|nullable',
        'tanggal_masuk' => 'required|date',
        'tanggal_keluar' => 'required|date',
        
    ]);

    if($request->file('image')){
        $validatedData['image'] = $request->file('image')->store('mahasiswa-images'); 
    }

 
    Mahasiswa::create($validatedData);

    return redirect('/admin/mahasiswa')->with('success', 'Data mahasiswa berhasil ditambahkan!');
}



public function edit(Mahasiswa $mahasiswa){

    return view('admin.mahasiswa.edit',[

        "title"=>"Edit $mahasiswa->nama",
        "mahasiswa" => $mahasiswa
    ]);
}

public function update(Request $request, Mahasiswa $mahasiswa)
{
    $rules = [
        'nim_nisn' => 'required',
        'nama' => 'required|string|max:255',
        'sekolah_univ' => 'required|string',
        'jurusan' => 'required|string',
        'alamat' => 'required|string',
        'no_telp' => 'required|string',
        'no_guru' => 'required|string',
        'image' => 'image|nullable',
        'tanggal_masuk' => 'required|date',
        'tanggal_keluar' => 'required|date',
    ];

  
  
    $validatedData = $request->validate($rules);

    if($request->file('image')){

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
        }

        $validatedData['image'] = $request->file('image')->store('mahasiswa-images'); 
    }

    // update di user juga jika nama dan email di ubah

    if ($request->nama != $mahasiswa->nama) {
        $validatedData['nama'] = $request->nama;

        if ($mahasiswa->user) {
            $mahasiswa->user->update(['name' => $request->nama]);
        }
    }

    if ($request->email != $mahasiswa->email) {
        $validatedData['email'] = $request->email;

        if ($mahasiswa->user) {
            $mahasiswa->user->update(['email' => $request->email]);
        }
    }

    if ($request->nim_nisn != $mahasiswa->nim_nisn) {
        $validatedData['nim_nisn'] = $request->nim_nisn;

        if ($mahasiswa->user) {
            $mahasiswa->user->update(['mahasiswa_id' => $request->nim_nisn]);
        }
    }

    $mahasiswa->update($validatedData);

    return redirect('/admin/mahasiswa')->with('success', 'Data mahasiswa berhasil diubah!');
}




public function destroy(Mahasiswa $mahasiswa){

    if($mahasiswa->image){
        Storage::delete($mahasiswa->image);
    }

   
    Mahasiswa::destroy($mahasiswa->nim_nisn);
    return redirect('/admin/mahasiswa')->with('success', 'Data mahasiswa berhasil di hapus!');
}
  

}
