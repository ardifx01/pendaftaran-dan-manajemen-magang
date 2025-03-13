<?php


namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;


class AbsensiController extends Controller
{
       public function index(){
        return view('admin.absensi.index' , [
            "title" => "ABSENSI",
            "mahasiswa" => Mahasiswa::latest()->filter(request(['search']))->paginate(5),
        ]);
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('absensi'); //eager loading

        return view('admin.absensi.show', [
            "title" => "ABSENSI MAHASISWA",
            "mahasiswa" => $mahasiswa,
            "absensi" => $mahasiswa->absensi
        ]);
    }

    public function showToday()
    {
        $today = now()->toDateString();
        
        $absensiToday = Absensi::with('mahasiswa')->where('tanggal', $today)->get();
    
        return view('admin.absensi.today', [
            'absensiToday' => $absensiToday,
            'title' => "ABSENSI HARI INI ",
        ]);
    }
    
    public function create(Mahasiswa $mahasiswa)
    {
       
        return view('admin.absensi.create', [
            'mahasiswa' => $mahasiswa,
            'title' => 'TAMBAH ABSENSI'
        ]);
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mahasiswa_id' => ['required', 'integer'],
            'status' => ['required', Rule::in(['hadir', 'tidak_hadir', 'izin', 'sakit'])],
            'keterangan' => ['nullable', 'string'],
            'tanggal' => [
                'required',
                'date',
                Rule::unique('absensi', 'tanggal')->where(function ($query) use ($request) {
                    return $query->where('mahasiswa_id', $request->mahasiswa_id);
                }),
            ],
        ], 
        
        [
            'mahasiswa_id.required' => 'Mohon pilih mahasiswa.',
            'status.required' => 'Status absensi wajib diisi.',
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'tanggal.required' => 'Tanggal absensi wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'tanggal.unique' => 'Mahasiswa sudah absen pada tanggal tersebut',
        ]);
    
       
        $validatedData['jam'] = now()->format('H:i:s');
    
        $existingAbsensi = Absensi::where([
            'mahasiswa_id' => $validatedData['mahasiswa_id'],
            'tanggal' => $validatedData['tanggal'],
        ])->first();
    
        $carbonDate = Carbon::parse($validatedData['tanggal']);
        $validatedData['hari'] = $carbonDate->isoFormat('dddd');
        $validatedData['keterangan'] = $validatedData['keterangan'] ?? ($validatedData['status'] === 'hadir' ? 'Hadir' : 'Tidak Hadir');
        
        $absensi = Absensi::create($validatedData);
    
        $nim_nisn = $absensi->mahasiswa->nim_nisn;
        $mahasiswa = $absensi->mahasiswa->nama;
    
        return redirect("/admin/absensi/{$nim_nisn}")->with('success', $mahasiswa . ' Berhasil Absen');
    }
    




    public function edit(Absensi $absensi)
    {

        return view('admin.absensi.edit', [
            'absensi' => $absensi,
            'title' => 'Edit'
        ]);
        
    }
    
    
    public function update(Request $request, Absensi $absensi){
        $rules = [
            'status' => ['required', Rule::in(['hadir', 'tidak_hadir', 'izin', 'sakit'])],
            'keterangan' => ['nullable', 'string'],
            'hari' => ['required'],
            'jam' => ['required'],
        ];
        
        if ($request->tanggal != $absensi->tanggal) {
            
            $rules['tanggal'] = 'required|date|unique:absensi,tanggal';
        }
    
        
        $validatedData = $request->validate($rules);
        Absensi::where('id', $absensi->id)->update($validatedData);
    
        $nim_nisn = $absensi->mahasiswa->nim_nisn;
        return redirect("/admin/absensi/{$nim_nisn}")->with('success',' Data  berhasil di ubah');
    }
    

    
    


    
    public function destroy(Absensi $absensi){
     
        $mahasiswa = $absensi->mahasiswa->nama;
        $nim_nisn = $absensi->mahasiswa->nim_nisn;
        $tanggal = $absensi->tanggal;


        Absensi::destroy($absensi->id);
        return redirect("/admin/absensi/{$nim_nisn}")->with('success','Absensi Dari ' . $mahasiswa . ' berhasil di hapus'
     );



    }
    
    

}
