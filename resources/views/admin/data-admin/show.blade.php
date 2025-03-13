@extends('layouts/main')
@section('container')

<div class="w-full h-full xl:h-screen bg-myBg flex items-center font-poppins laptop:flex-col">
    @include('/layouts/navApp')
    
        <div class="container flex flex-col mx-auto p-10 laptop:p-3">
            <div class="w-full desktop:w-full h-250 desktop:h-auto bg-medium mx-auto flex flex-col text-white  rounded-3xl shadow-3xl ">

                <div class="w-full my-gradient lg:p-10 laptop:py-5  flex desktop:flex-col items-center rounded-3xl tablet:rounded-none shadow-3xl mx-auto text-white tablet:px-5">
                    <div class="flex items-center">
    
                        <a href="{{route('data-admin.index')}}"
                            class=" flex items-center justify-center w-20 h-20  tablet:w-12 tablet:h-12  bg-white text-primary text-4xl tablet:text-2xl rounded-full hover-white shadow-3xl">
                            <iconify-icon icon="teenyicons:left-solid"></iconify-icon>
                        </a>

                        <div class="max-h-48 overflow-hidden">
                        <img src="{{asset('storage/'. $admin->image )}}"
                            class="ml-5 w-48 h-48 laptop:w-28 laptop:h-28 rounded-full object-cover object-center shadow-3xl bg-white">
                        </div>

                    </div>
    
                    <div class="desktop:mt-5 lg:ml-10">
                        <h1 class="text-4xl laptop:text-3xl font-bold" >
                            <span id="typed-output"></span>
                        </h1>
                      

                        @if($admin->devisi)
                        <h3 class="text-xl tablet:text-sm mt-3">Devisi : {{ $admin->devisi->nama_devisi }}</h3>
                    @else
                    <h3 class="text-lg text-red-500 tablet:text-sm">Devisi TIdak Tersedia</h3>

                    @endif


                        <div class="flex justify-center mt-5">
                   
                        
                       
                            <a href="{{route('data-admin.edit', $admin->nip)}}"
                            class="ml-5 text-lg laptop:text-sm bg-white  w-40 h-10 laptop:w-20 laptop:h-10 rounded-full text-primary font-semibold flex items-center justify-center hover-white shadow-3xl">
                            <iconify-icon icon="akar-icons:edit" class="mr-3 laptop:hidden"></iconify-icon>
                            Edit</a>
                     
                        <form action="" method="post" id="deleteForm">
                            @method('delete')
                            @csrf
                            <button class="ml-5 text-lg laptop:text-sm bg-white w-40 h-10 laptop:w-20 laptop:h-10 rounded-full text-primary font-semibold flex items-center justify-center hover-white shadow-3xl"
                                    onclick="showConfirmationDialog(event)">
                                <iconify-icon icon="zondicons:trash" class="mr-3 laptop:hidden"></iconify-icon>
                                Hapus
                            </button>
                        </form>
                    </div>
                    </div>
    
                </div>

                <div class=" w-11/12 mx-auto laptop:flex-col  flex text-xl p-12 laptop:p-10 laptop:text-lg ">

                    <div class="animate__animated animate__fadeInLeft bg-slate-900 p-10">
                        <p class=""><span class="font-bold ">Nip Pegawai (admin)</span> <br>{{ $admin->nip}}</p>
                        <p class="mt-10 laptop:mt-5"><span class="font-bold ">Email :</span> <br> {{ $admin->email }}
                        </p>
                        <p class="mt-10 laptop:mt-5"><span class="font-bold ">Alamat :</span> <br>
                            {{ $admin->alamat }}</p>
                        <p class="mt-10 laptop:mt-5"> <span class="font-bold ">No.Hp :</span> <br> {{ $admin->no_telp }}
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-80 z-50 hidden" id="confirmationContainer">
            <div id="confirmationDialog" class="flex flex-col justify-between fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-primary text-white w-11/12 md:w-2/3 lg:w-2/5 xl:w-2/6 h-52 p-6 rounded-lg shadow-lg z-60">
                <p class="text-lg">Apakah Anda yakin ingin menghapus data dari {{ $admin->nama }}?</p>
                <div class="flex justify-evenly">
                    <button class="w-1/2 h-10 hover-white bg-white text-primary  mr-2 rounded" onclick="proceedDelete()">Ya</button>
                    <button class="w-1/2 h-10 hover-white bg-white text-primary rounded" onclick="cancelDelete()">Batal</button>
                </div>
            </div>
        </div>
    @endsection

    <!--Typed.js -->
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            strings: ["{{ $admin->nama }}"],
            typeSpeed: 70,
            backSpeed: 25,
            backDelay: 1000,
            loop: false
        };

        var typed = new Typed("#typed-output", options);
    });
</script>
