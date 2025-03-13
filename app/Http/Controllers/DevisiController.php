<?php

namespace App\Http\Controllers;
use App\Models\Devisi;
use Illuminate\Http\Request;

class DevisiController extends Controller
{
    public function index(){

        $devisi = Devisi::latest()->filter(request(['search']))->paginate(5);

        return view('admin.devisi.index',[
            "devisi" => $devisi,
            "title" => "DEVISI"
        ]);
    }

    public function edit(Devisi $devisi){

        return view('admin.devisi.edit',[
            "devisi" => $devisi,
            "title" => "DEVISI"
        ]);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            "nama_devisi" => "required",
            "deskripsi" => "required",
        ]);

        Devisi::create($validatedData);
        return redirect()->route("devisi.index")->with('success','Devisi Berhasil Di Tambahkan');
    }

    public function update(Devisi $devisi, Request $request){
        $validatedData = $request->validate([
            "nama_devisi" => "required",
            "deskripsi" => "required",
        ]);

 
        Devisi::where('id',$devisi->id)
        ->update($validatedData);

        return redirect()->route('devisi.index')->with('success', 'Devisi berhasil di Ubah!');

    }

    public function destroy(Devisi $devisi){
        Devisi::destroy($devisi->id);
        return redirect()->route('devisi.index')->with('success', 'Devisi berhasil di hapus!');
    }
}
