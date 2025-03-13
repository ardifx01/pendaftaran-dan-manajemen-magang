<!-- resources/views/admin/absensi/show.blade.php -->

@extends('layouts.main')
@section('container')
    <div class="w-full h-screen laptop:h-auto bg-myBg flex items-center font-poppins laptop:flex-col">
        @include('/layouts/navApp')
        <div class="sm:p-5 w-9/12 desktop:w-full  mx-auto ">
            <div class=" bg-medium w-full h-250 desktop:h-auto  rounded-3xl shadow-3xl animate__animated animate__fadeInUp">

                {{-- header --}}
                <div
                    class="w-full h-28 my-gradient flex items-center  tablet:rounded-none shadow-3xl text-white justify-between px-10 ">

                    <h1 class="text-lg sm:text-2xl lg:text-4xl font-bold tracking-wider">
                        <span id="typed-output"></span>
                    </h1>

                    {{-- Search --}}

                        {{-- search --}}
                        <form action="{{route('devisi.index')}}">   
                            <label for="search" class="text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="text" id="search" name="search" value="{{request('search')}}" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
                                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-4 py-2 dark:bg-primary dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                            </div>
                          </form>
                          {{-- end search --}}
                    {{-- end search --}}

                </div>
                {{-- header end --}}

                <div class="flex laptop:flex-col w-full justify-around ">
                    {{-- Input Devisi  --}}

                    <div class="w-2/6 laptop:w-full mt-10 h-80 shadow-3xl  bg-myBg animate__animated animate__fadeInLeft">

                        <div class="bg-primary shadow-3xl w-full h-16 flex items-center justify-center text-white">
                            <h3 class="text-lg font-bold tracking-wider">
                                Input Devisi
                            </h3>
                        </div>
                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded flex items-center relative mb-10"
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

                        <form action="{{route('devisi.store')}}" method="post" enctype="multipart/form-data"
                            class="flex flex-col text-white p-10 w-full max-w-screen-md mx-auto">
                            @csrf

                            <input type="text" id="nama_devisi" name="nama_devisi" placeholder="Nama Devisi Pegawai"
                                required
                                class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500"
                                value="{{ old('nama_devisi') }}">

                            <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi Devisi" required
                                class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500">{{ old('devisi') }}</textarea>


                            <button type="submit"
                                class=" bg-primary text-white px-6 py-3 rounded-md 0 focus:outline-none focus:shadow-outline-primary hover-primary">Tambah</button>
                        </form>
                    </div>



                    {{-- Data devisi --}}

                    <div class=" w-2/4 laptop:w-full mt-10 overflow-auto bg-myBg p-5 animate__animated animate__fadeInRight">
                        @if ($devisi->count() > 0)
                            <table class="text-center w-full border border-collapse text-white" cellspacing="0">
                                <thead>
                                    <tr class="bg-primary">
                                        <th class="border p-2">No.</th>
                                        <th class="border p-2">Devisi</th>
                                        <th class="border p-2">Deskripsi</th>
                                        <th class="border p-2 w-1/5">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($devisi as $data)
                                        <tr>
                                            <td class="border p-2">{{ ($loop->index + 1) + ($devisi->perPage() * ($devisi->currentPage() - 1)) }}</td>
                                            <td class="border p-2"> {{ $data->nama_devisi }}</td>
                                            <td class="border p-2">{{ $data->deskripsi }}</td>

                                            <td class="border p-2 ">
                                                <div class="flex justify-center desktop:flex-wrap">
                                                    <form action="{{route('devisi.destroy', $data->id)}}" method="post"
                                                        id="deleteForm">
                                                        @method('delete')
                                                        @csrf
                                                        <button onclick="showConfirmationDialog(event)"
                                                            class="mr-3 h-10 w-10 bg-red-500  hover:bg-red-700">
                                                            <iconify-icon icon="zondicons:trash"></iconify-icon>
                                                        </button>
                                                    </form>

                                                    <a href="{{ route('devisi.edit', $data->id) }}"
                                                        class="mr-3 h-10 w-10 bg-yellow-400  hover:bg-yellow-600 items-center flex justify-center">
                                                        <iconify-icon icon="akar-icons:edit"></iconify-icon>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-5">
                                {{ $devisi->links() }}
                            </div>
                        @else
                            <p class="text-xl mt-10 text-center text-white">Devisi Tidak Ditemukan.</p>
                        @endif
                    </div>
                    {{-- end data devisi --}}

                </div>
            </div>
        </div>

    </div>

    {{-- confirm delete --}}
    <div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-80 z-50 hidden" id="confirmationContainer">
        <div id="confirmationDialog"
            class="flex flex-col justify-between fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-primary text-white w-11/12 md:w-2/3 lg:w-2/5 xl:w-2/6 h-52 p-6 rounded-lg shadow-lg z-60">
            <p class="text-lg">Apakah Anda yakin ?</p>
            <div class="flex justify-evenly">
                <button class="w-1/2 h-10 hover-white bg-white text-primary  mr-2 rounded"
                    onclick="proceedDelete()">Ya</button>
                <button class="w-1/2 h-10 hover-white bg-white text-primary rounded" onclick="cancelDelete()">Batal</button>
            </div>
        </div>
    </div>

    {{-- success massage --}}
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
            }, 3000);
            
            function hideMessage(elementId) {
                document.getElementById(elementId).style.display = 'none';
            }
            </script>
    @endif
    {{-- end success messege --}}

@endsection
<!--Typed.js -->
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            strings: ["Devisi Pegawai"],
            typeSpeed: 50,
            backSpeed: 25,
            backDelay: 1000,
            loop: false
        };

        var typed = new Typed("#typed-output", options);
    });
</script>

<script>
    function showAbsensi(id) {
        var absensi = document.getElementById('absensiDropDown_' + id);
        var btn = document.getElementById('showBtn_' + id);
        var icon = document.getElementById('iconBtn_' + id);

        if (absensi.classList.contains('hidden')) {
            absensi.classList.remove('hidden');
            absensi.classList.add('animate__fadeInDown');
            icon.innerHTML = '<iconify-icon icon="zondicons:close-outline"></iconify-icon>';
        } else {
            absensi.classList.add('animate__fadeOutUp');
            setTimeout(() => {
                absensi.classList.add('hidden');
                absensi.classList.remove('animate__fadeOutUp');
            }, 300);
            icon.innerHTML = '<iconify-icon icon="icon-park-solid:down-two"></iconify-icon>';
        }
    }
</script>

