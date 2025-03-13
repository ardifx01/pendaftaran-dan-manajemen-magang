<!-- resources/views/admin/absensi/show.blade.php -->

@extends('layouts.main')

@section('container')
    <div class="w-full phone:h-auto h-screen bg-myBg flex items-center font-poppins laptop:flex-col">
        @include('/layouts/mahasiswaNav')

        <div class="p-5 w-9/12 laptop:w-full  mx-auto text-white">
            <div class="bg-medium w-full h-auto xl:h-250 rounded-3xl laptop:rounded-none shadow-3xl ">

                <div
                    class="w-full my-gradient laptop:text-center flex laptop:flex-col items-center rounded-3xl laptop:rounded-none shadow-3xl py-5">
                   
                    <div class="max-h-48 overflow-hidden">
                        <img src="{{asset('storage/'. $mahasiswa->image )}}"
                            class="ml-5 w-44 h-44 laptop:w-28 laptop:h-28 rounded-full object-cover object-center shadow-3xl bg-white">
                        </div>

                    <div class="ml-20 laptop:ml-10 h-full flex flex-col justify-center ">
                        <h1 class="text-lg sm:text-2xl lg:text-4xl font-bold tracking-wider">
                            <span id="typed-output"></span>
                        </h1>
                        <h3 class="text-lg  lg:text-2xl tracking-wider mt-2">{{ $mahasiswa->sekolah_univ }}</h3>

                        <div class="flex justify-between">
                            <a href="{{ route('absensi-mahasiswa.index') }}"
                                class="mt-5 text-md  bg-white h-12 w-40 laptop:w-32 laptop:h-10  laptop:text-sm rounded-full text-primary shadow-3xl flex items-center justify-center hover:scale-105 hover-white">
                                <iconify-icon icon="teenyicons:left-solid"
                                    class="mr-2 text-xl laptop:text-sm"></iconify-icon>
                                Kembali
                            </a>

                            <a href="{{ route('absensi-mahasiswa.create') }}"
                                class="ml-5 mt-5 text-md bg-white h-12 w-40 laptop:w-32 laptop:h-10  laptop:text-sm rounded-full text-primary shadow-3xl flex items-center justify-center hover:scale-105 hover-white">
                                <iconify-icon icon="zondicons:add-solid" class="mr-2 text-xl laptop:text-sm"></iconify-icon>
                                Absen
                            </a>
                        </div>
                    </div>

                </div>



                @foreach ($paginator->items() as $minggu => $absensiMinggu)
                    <div class="px-5  w-full mt-5">

                        <div class="lg:mt-10 flex justify-between desktop:flex-col-reverse xl:items-center">
                        

                            <div class="mt-10">

                                {{ $paginator->links() }}
                            </div>
                           


                            <h3 class="laptop:mt-5 text-lg  lg:text-2xl tracking-wider"> Minggu ke - {{ $currentPage }} </h3>



                            <form action="{{route('absensi-mahasiswa.index')}}" class="laptop:mt-5">
                                <label for="search"
                                    class="text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="search" name="search"
                                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Search..." required>
                                    <button type="submit"
                                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-4 py-2 dark:bg-primary dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                                </div>
                            </form>


                        </div>

                        <table class="mt-5 text-center w-full border border-collapse  animate__animated animate__fadeInUp" cellspacing="0">
                            <!-- Bagian header tabel -->
                            <thead>
                                <tr class="bg-primary">
                                    <th class="border p-2">No.</th>
                                    <th class="border p-2">Tanggal</th>
                                    <th class="border p-2">Hari</th>
                                    <th class="border p-2">Status</th>
                                    <th class="border p-2">Jam</th>
                                    <th class="border p-2">Keterangan</th>
                                </tr>
                            </thead>
                            <!-- Bagian body tabel -->
                            <tbody>
                                @if ($absensi->count() > 0)
                                    @foreach ($absensiMinggu as $absensiItem)
                                        <tr>
                                            <td class="border p-2">{{ $loop->iteration }}</td>
                                            <td class="border p-2">
                                                {{ \Carbon\Carbon::parse($absensiItem->tanggal)->translatedFormat('d F Y') }}
                                            </td>
                                            <td class="border p-2">{{ $absensiItem->hari }}</td>
                                            <td class="border p-2">{{ $absensiItem->status }}</td>
                                           <td class="border p-2">{{ \Carbon\Carbon::parse($absensiItem->jam)->translatedFormat('H:i') }}</td>
                                            <td class="border p-2">{{ $absensiItem->keterangan }}</td>
                                   
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-md mt-2">Tidak ada data absensi untuk minggu ini.</p>
                @endif
            </div>
            @endforeach


        </div>
    </div>
    </div>

    @if (session()->has('success'))
    <div id="successMessage" class="absolute -top-5 left-0 right-0 animate__animated animate__fadeInLeft ">
        <div class="bg-green-500 px-5 py-4 text-white text-center w-1/2 mt-10 relative mx-auto" role="alert">
            {{ session('success') }}
            <button class="absolute top-0 right-0 mt-2 mr-4 text-xl font-semibold cursor-pointer"
                onclick="hideMessage('successMessage')">&times;</button>
        </div>
    </div>

    <script>
        setTimeout(function() {
            document.getElementById('successMessage').style.display = 'none';
        }, 4000);

        function hideMessage(elementId) {
            document.getElementById(elementId).style.display = 'none';
        }
    </script>
@endif

<!--Typed.js -->
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            strings: ["{{ $mahasiswa->nama }}"],
            typeSpeed: 50,
            backSpeed: 25,
            backDelay: 1000,
            loop: false
        };

        var typed = new Typed("#typed-output", options);
    });
</script>
@endsection
