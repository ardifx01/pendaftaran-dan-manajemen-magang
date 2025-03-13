<!-- admin.absensi.create.blade.php -->
@extends('layouts/main')

@section('container')


<div class="w-full lg:h-screen bg-myBg flex items-center font-poppins laptop:flex-col">
            @include('/layouts/navApp')
       


            <div class="p-5 w-2/5 laptop:w-full  mx-auto ">
    
                <div class=" bg-medium w-full rounded-3xl shadow-3xl">
            <div class=" bg-primary p-5 flex text-white items-center rounded-3xl tablet:rounded-none shadow-3xl">
                <a href="/admin/absensi/show/"
                    class="flex items-center justify-center w-20 h-20 tablet:w-10 tablet:h-10 bg-white text-primary text-4xl tablet:text-2xl rounded-full hover-white ">
                    <iconify-icon icon="teenyicons:left-solid"></iconify-icon>
                </a>
                <div class="ml-12">
                    <h1 class="text-3xl tablet:text-xl font-bold">{{ $title }}</h1>
                </div>
            </div>

            <form action="/admin/absensi/{{ $absensi->id }}" method="post"
                class="flex flex-col text-white mt-5 w-full max-w-screen-md px-10 pb-10 mx-auto">
                @csrf
                @method('put')

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded flex items-center relative"
                        role="alert">
                        <ul class="list-disc ml-5 mb-0 flex-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="ml-4 text-xl font-semibold cursor-pointer"
                            onclick="this.parentElement.style.display='none'">&times;</button>
                    </div>
                @endif


                <label for="mahasiswa_id" class="mb-2">NIM/NISN :</label>
                <input type="text" name="mahasiswa_id" id="mahasiswa_id"
                    value="{{ old('mahasiswa_id', $absensi->mahasiswa_id) }}"
                    class="mb-4 px-4 py-2 text-slate-800 rounded-md border border-gray-300 focus:outline-none focus:border-primary">

                <label for="status" class="mb-2">Status :</label>
                <select name="status" id="status"
                    class="mb-4 px-4 py-2 text-slate-800 rounded-md border border-gray-300 focus:outline-none focus:border-primary">
                    <option value="hadir">Hadir</option>
                    <option value="tidak_hadir">Tidak Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                </select>

                <label for="keterangan" class="mb-2">Keterangan :</label>
                <textarea name="keterangan" id="keterangan" 
                    class="text-slate-800 mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary">{{ old('keterangan', $absensi->keterangan) }}</textarea>


                <label for="tanggal" class="mb-2">Tanggal :</label>
                <input type="date" name="tanggal" id="tanggal"
                    class="mb-4 px-4 py-2 text-slate-800 rounded-md border border-gray-300 focus:outline-none focus:border-primary"
                    value="{{ old('tanggal', $absensi->tanggal) }}">


                <label for="jam" class="mb-2">Jam :</label>
                <input type="text" name="jam" id="jam"
                    value="{{ old('jam', \Carbon\Carbon::parse($absensi->jam)->format('H:i')) }}"
                    class="mb-4 px-4 py-2 text-slate-800 rounded-md border border-gray-300 focus:outline-none focus:border-primary">


                <label for="hari" class="mb-2">Hari :</label>
                <input type="text" name="hari" id="hari" value="{{ old('hari', $absensi->hari) }}"
                    class="mb-4 px-4 py-2 text-slate-800 rounded-md border border-gray-300 focus:outline-none focus:border-primary">


                <button type="submit"
                    class="text-xl font-bold mt-10 bg-primary text-white px-6 py-3 rounded-md focus:outline-none hover-primary">Absen</button>
            </form>
        </div>
    </div>
</div>



@endsection

<script src="{{asset('js/responsiveNavbar.js')}}"></script>
