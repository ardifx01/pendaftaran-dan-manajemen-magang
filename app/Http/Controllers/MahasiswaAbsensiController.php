<?php

namespace App\Http\Controllers;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;


class MahasiswaAbsensiController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $absensi = $user->mahasiswa->absensi()->filter(['search' => request('search')])->with('mahasiswa')->orderBy('tanggal', 'asc')->get();
    
        $absensiPerMinggu = $absensi->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal)->weekOfYear; // Mengelompokkan berdasarkan minggu dalam setahun
        });
    
        $currentPage = request()->query('page', 1);
        $perPage = 1; 
    
        // Membuat instance LengthAwarePaginator untuk data absensi perminggu
        $paginator = new LengthAwarePaginator(
            $absensiPerMinggu->forPage($currentPage, $perPage)->values(),
            $absensiPerMinggu->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    
        return view('mahasiswa.absensi.index', [
            'title' => 'Absensi Saya',
            'absensi' => $absensi,
            'absensiPerminggu' => $absensiPerMinggu,
            'mahasiswa' => $mahasiswa,
            'paginator' => $paginator,
            'currentPage' => $currentPage,
        ]);
    }
    


    public function create(){

       $user = Auth::user();
       $mahasiswa = $user->mahasiswa;

        return view('mahasiswa.absensi.create',[
            "title" =>"Absensi",
            "mahasiswa" => $mahasiswa
        ]);

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mahasiswa_id' => 'required',
            'status' => ['required', Rule::in(['hadir', 'tidak_hadir', 'izin', 'sakit'])],
            'keterangan' => ['nullable', 'string'],
            'tanggal' => [
                'required',
                'date',
                Rule::unique('absensi', 'tanggal')->where(function ($query) use ($request) {
                    $query->where('mahasiswa_id', $request->mahasiswa_id);
                }),
            ],
        ],
        [
            'tanggal.unique' => 'Anda sudah absen',
        ]);
    
        $jamMulaiAbsen = Carbon::parse('07:00:00');
        $jamBatasTerlambat = Carbon::parse('8:00:00');
        $jamBatasAkhirAbsen = Carbon::parse('24:00:00');
        $jamSekarang = Carbon::now();
    
        $carbonDate = Carbon::parse($validatedData['tanggal']);
        $validatedData['hari'] = $carbonDate->isoFormat('dddd');
        $validatedData['jam'] = $jamSekarang->format('H:i:s');
    
        if ($carbonDate->isWeekend()) {
            return redirect()->back()->withErrors(['pesan' => 'Hari libur, tidak bisa absen.']);
        }
    
        if ($jamSekarang->lessThan($jamMulaiAbsen) || $jamSekarang->greaterThanOrEqualTo($jamBatasAkhirAbsen)) {
            return redirect()->back()->withErrors(['pesan' => 'Batas waktu absen telah berakhir.']);
        }
    
        if ($jamSekarang->lessThan($jamBatasTerlambat)) {
            $validatedData['keterangan'] = 'Tepat Waktu';
        } else {
            $validatedData['keterangan'] = 'Terlambat';
        }
    
        $absensi = Absensi::create($validatedData);
        return redirect()->route('absensi-mahasiswa.index')->with('success', 'Anda Berhasil Absen');
    }
    
    
    
    
}
   