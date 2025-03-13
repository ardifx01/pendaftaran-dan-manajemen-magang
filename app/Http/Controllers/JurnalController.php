<?php

namespace App\Http\Controllers;
use App\Models\Jurnal;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JurnalController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $perPage = 1; 
        $jurnal = $user->mahasiswa->jurnal()->filter(['search' => request('search')])->with('mahasiswa')->orderBy('tanggal', 'asc')->get();
    
        $jurnalPerMinggu = $jurnal->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal)->startOfWeek(); // Mengelompokkan berdasarkan awal minggu
        });
    
        $currentPage = request()->query('page', 1);
    
        // Membuat instance LengthAwarePaginator untuk data jurnal perminggu
        $paginator = new LengthAwarePaginator(
            $jurnalPerMinggu->forPage($currentPage, $perPage)->values(),
            $jurnalPerMinggu->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    
        return view('mahasiswa.jurnal.index', [
            'title' => "Jurnal Saya",
            'jurnal' => $jurnal,
            'jurnalMinggu' => $jurnalPerMinggu,
            'paginator' => $paginator,
            'mahasiswa' => $mahasiswa,
            'currentPage' => $currentPage
        ]);
    }

    public function create(){

       $user = Auth::user();
       $absensi = $user->mahasiswa->absensi()->latest()->get();
       $mahasiswa = $user->mahasiswa;

        return view('mahasiswa/jurnal/create',[
            'title' =>'Tambah Kegiatan',
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function edit(Jurnal $jurnal){

    
        $user = Auth::user();
        $absensi = $user->mahasiswa->absensi()->with('mahasiswa')->orderBy('tanggal', 'asc')->get();   
        $mahasiswa = $user->mahasiswa;

        return view('mahasiswa.jurnal.edit',[

            "title" =>"Edit Jurnal",
            "mahasiswa" => $mahasiswa,
            "jurnal" => $jurnal
            
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required',
            'hari' => 'required',
            'tanggal' => 'required|date',
        ]);

        $user = Auth::user();
        $nim_nisn = $user->mahasiswa->nim_nisn;

        Jurnal::create([
            'mahasiswa_id' => $nim_nisn,
            'kegiatan' => $request->kegiatan,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('jurnal.index')->with('success', 'Jurnal berhasil ditambahkan');
    }


    public function update(Request $request, Jurnal $jurnal){

        $rules =[
            'kegiatan' => 'required',
            'hari' => 'required',
            
        ];
    
        
        if ($request->tanggal != $jurnal->tanggal) {
            $rules['tanggal'] = 'required|date|unique:jurnal,tanggal';
        }
    
    
       $valdatedData = $request->validate($rules);
     
        Jurnal::where('id',$jurnal->id)
                  ->update($valdatedData);
    
        return redirect('/mahasiswa/jurnal')->with('success', 'Jurnal berhasil di ubah!');
    
    }

    public function destroy(Jurnal $jurnal){
     

        Jurnal::destroy($jurnal->id);
        return redirect()->route('jurnal.index')->with('success','Jurnal anda berhasil di hapus!');
     

    }
}
