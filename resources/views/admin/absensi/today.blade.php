<!-- resources/views/admin/absensi/show.blade.php -->

@extends('layouts.main')

@section('container')
    <div class="w-full h-screen bg-myBg flex items-center font-poppins">

      
        @include('layouts.navApp')





        <div class="container p-10 mx-auto h-90% text-white w-9/12 bg-medium rounded-3xl shadow-3xl">


            <div class="flex w-full justify-between ">
                <h1 class="text-5xl font-bold">{{ $title }}</h1>

                <a href="/admin/absensi"
                    class="text-md bg-white h-12 w-40 rounded-full shadow-3xl text-primary flex items-center justify-center hover:scale-105 hover:border-white hover:text-white hover:bg-transparent transition duration-200 ease-in-out">
                    <iconify-icon icon="clarity:list-solid"></iconify-icon>
                    Semua Data
                </a>
            </div>


       <div class="overflow-auto h-90% mt-10">
            @if ($absensiToday->count() > 0)
                <table class="text-center w-full border border-collapse text-white" cellspacing="0" >
                    <thead>
                        <tr class="bg-primary">
                            <th class="border p-2">No</th>
                            <th class="border p-2">Nama</th>
                            <th class="border p-2">Tanggal</th>
                            <th class="border p-2">Hari</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2 w-2/6">Keterangan</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absensiToday as $absensiItem)
                            <tr>
                                <td class="border p-2">{{ $loop->iteration }}</td>
                                <td class="border p-2">
                                    {{ $absensiItem->mahasiswa->nama }}
                                </td>
                                <td class="border p-2">
                                    {{ \Carbon\Carbon::parse($absensiItem->tanggal)->translatedFormat('d F Y') }}
                                </td>
                                <td class="border p-2">{{ $absensiItem->hari }}</td>
                                <td class="border p-2">{{ $absensiItem->status }}</td>
                                <td class="border p-5">{{ $absensiItem->keterangan }}</td>
                             
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <p>Tidak ada data absensi untuk hari ini.</p>
            @endif
        </div>
    </div>
    </div>
@endsection
<script src="{{asset('js/responsiveNavbar.js')}}"></script>
