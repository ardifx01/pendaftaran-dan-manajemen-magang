<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AcceptanceEmail;
use App\Models\PermintaanMagang;


class DashboardController extends Controller
{
    public function admin() {

        $user = Auth::user();
    
        if ($user->role === 'admin' || $user->role === 'super') {
           
            $today = now()->toDateString();
            $absensiToday = Absensi::with('mahasiswa')->where('tanggal', $today)->get()->count();
            
            return view('admin.dashboard.index', [
                "title" => "Dashboard",
                "jmlMahasiswa" => Mahasiswa::count(),
                "jmlUsers" => User::count(), 
                "jmlPermintaan" => PermintaanMagang::count(),
                "jmlAbsen" =>$absensiToday,
            ]);
        } else {
           
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }
    }

    // public function acceptRegistration($permintaanId)
    // {
    //     $permintaan = PermintaanMagang::findOrFail($permintaanId);

    //     // Simpan data ke tabel "mahasiswa"
    //     $mahasiswa = User::create([
    //         'name' => $permintaan->name,
    //         'email' => $permintaan->email,
    //         // Tambahkan field lain sesuai kebutuhan
    //     ]);

    //     // Kirim email ke mahasiswa
    //     Mail::to($permintaan->email)->send(new AcceptanceEmail($mahasiswa));

    //     // Hapus data dari tabel "permintaan" jika diperlukan
    //     $permintaan->delete();

    //     return redirect()->back()->with('success', 'Pendaftaran diterima. Email konfirmasi telah dikirim ke mahasiswa.');
    // }
    

       public function mahasiswa(){
        
        $user = Auth::user();
        $today = now()->toDateString();
        $absensiToday = Absensi::with('mahasiswa')->where('tanggal', $today)->get()->count();

        return view('mahasiswa.dashboard.index' , [
            "title" => "Dashboard",
                "mahasiswa" => $user->mahasiswa ? $user->mahasiswa->nama : null,
                "admin" => $user->admin ? $user->admin->nama : null,
                "jmlJurnal" => Jurnal::count(),
                "jmlAbsensi" => Absensi::count(),   
                "jmlAbsen" =>$absensiToday,
                "auth" => $user->admin ? $user->admin->nama : ($user->mahasiswa ? $user->mahasiswa->nama : null),

    
        ]);
       }
}
