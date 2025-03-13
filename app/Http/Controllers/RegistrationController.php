<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentRegistration;
use App\Models\Mahasiswa;
use App\Models\PermintaanMagang;

class RegistrationController extends Controller
{
    public function showForm()
    {
        return view('registration',[

            "title" => "Pendaftaran"
        ]);
    }

    public function submitForm(Request $request)
    {
        
        $validatedData = $request->validate([
            'nim_nisn' => 'required|unique:permintaan_magang,nim_nisn|unique:mahasiswa,nim_nisn',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:permintaan_magang,email',
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




        $permintaan = PermintaanMagang::create($validatedData);
        Mail::to('thisrosan666@gmail.com')->send(new StudentRegistration($permintaan));
     
        

        return redirect()->back()->with([
            'success' => 'Pendaftaran berhasil!, Mohon tunggu konfirmasi dari admin.',
            'title' => 'Pendaftaran Berhasil'
        ]);
        
      

    }



}
