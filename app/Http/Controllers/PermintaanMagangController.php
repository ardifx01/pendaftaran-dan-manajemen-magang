<?php

namespace App\Http\Controllers;

use App\Models\PermintaanMagang;
use Illuminate\Http\Request;
use App\Mail\AcceptanceEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Mahasiswa;
use App\Models\Permintaan;

class PermintaanMagangController extends Controller
{
    public function index(){

        return view('admin.permintaan-magang.index',[

            "title" => "Permintaan Magang",
            "permintaan" => PermintaanMagang::latest()->get()

        ]);
    }

    public function show(PermintaanMagang $permintaanMagang){

        return view('admin.permintaan-magang.show',[

            "permintaan" => $permintaanMagang,
            "title" => "permintaan magang"
        ]);
        
    }

 



    public function accept($nim_nisn)
    {
        $permintaan = PermintaanMagang::where('nim_nisn', $nim_nisn)->first();
    
        if (!$permintaan) {
            return redirect()->back()->with('error', 'Permintaan tidak ditemukan.');
        }
    
        $imageValidation = Validator::make(['image' => $permintaan->image], [
            'image' => 'image|nullable', 
        ]);

        $emailValidation = Validator::make(['email' => $permintaan->email], [
            'email' => 'unique:admin,email|unique:mahasiswa,email|unique:permintaan_magang,email',
        ], [
            'email.unique' => 'Email sudah digunakan oleh salah satu dari admin, mahasiswa, atau permintaan magang.',
        ]);

        $nimNisnValidation = Validator::make(['nim_nisn' => $permintaan->nim_nisn], [
            'nim_nisn' => 'unique:mahasiswa,nim_nisn|unique:permintaan_magang,nim_nisn',
        ], [
            'nim_nisn.unique' => 'Nim Atau Nisn sudah terdaftar',
        ]);
    

        $mahasiswaData = [
            'nim_nisn' => $permintaan->nim_nisn,
            'nama' => $permintaan->nama,
            'email' => $permintaan->email,
            'sekolah_univ' => $permintaan->sekolah_univ,
            'jurusan' => $permintaan->jurusan,
            'alamat' => $permintaan->alamat,
            'no_telp' => $permintaan->no_telp,
            'no_guru' => $permintaan->no_guru,
            'image' => $permintaan->image, 
            'tanggal_masuk' => $permintaan->tanggal_masuk,
            'tanggal_keluar' => $permintaan->tanggal_keluar,
        ];
    
        Mail::to($mahasiswaData['email'])->send(new AcceptanceEmail($mahasiswaData));
        Mahasiswa::create($mahasiswaData);
    
        $permintaan->delete();
        return redirect('/admin/mahasiswa')->with('success', 'Permintaan diterima, data berhasil ditambahkan!');
    }
    
    public function destroy(PermintaanMagang $permintaanMagang){

   
        PermintaanMagang::destroy($permintaanMagang->nim_nisn);
        return redirect('/admin/permintaan-magang')->with('success', 'Data  berhasil di hapus!');
    }
    
    
    
}
