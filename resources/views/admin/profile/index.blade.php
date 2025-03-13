@extends('layouts/main')

@section('container')
    <div class="w-full h-screen bg-myBg flex justify-beetwen items-center font-poppins laptop:flex-col">

        <div class="laptop:hidden">

            @include('/layouts/navApp')
        </div>


        <div class="w-full h-20 bg-primary flex items-center justify-between p-5 text-white lg:hidden ">
            
            <div class="w-10 h-10 bg-white rounded-full">
            </div>

            <div
                class=" text-sm w-72 h-10 items-center bg-white bg-opacity-25 flex justify-between px-5 rounded-full font-semibold ">
                <iconify-icon icon="uis:calender"></iconify-icon>
                <p id="tanggal"></p>
                <p id="jam" class="ml-4"></p>

            </div>
        </div>


        <div class="flex-col w-full">
            <div class="w-full flex flex-col mx-auto laptop:mt-10">

                <div
                    class="w-2/3 bg-primary px-10 py-5 flex items-center rounded-3xl tablet:rounded-none shadow-3xl mx-auto z-50 text-white tablet:w-full tablet:flex-col relative">


                    <a href="/admin/data-admin"
                        class="flex items-center justify-center w-16 h-16 bg-white tablet:bg-primary text-primary tablet:text-white tablet:shadow-none text-4xl rounded-full hover-white shadow-3xl tablet:absolute tablet:left-4">
                        <iconify-icon icon="teenyicons:left-solid"></iconify-icon>
                    </a>


                    @if(auth()->user()->admin->image)
                    <img src="{{ asset('storage/'.auth()->user()->admin->image) }}"
                  
                    class="ml-5 w-48 h-48 tablet:w-16 tablet:h-16 rounded-full object-cover object-center mr-4">
                @else
                    <img src="https://source.unsplash.com/500x400/?profile" alt=""
                    class=" w-52 h-52 tablet:w-16 tablet:h-16 rounded-full object-cover object-center mr-4">
                @endif
                  
                    <h1 class="ml-10 text-5xl font-bold mt-5">
                        <span id="typed-output"></span>
                    </h1>
                </div>
            </div>

            <div class="w-2/3 p-10 bg-medium mx-auto flex flex-col text-white  -mt-5 tablet:w-full animate__animated animate__fadeInUp">

                <div class=" w-full flex  text-xl">

                  
                        <div>

                            <p class="mt-10"> <span class="font-bold ">NIP :</span> <br> {{ $admin->nip }}</p>
                            <p class="mt-10"><span class="font-bold ">Email :</span> <br> {{ $admin->email }}</p>
                            <p class="mt-10"><span class="font-bold ">Alamat :</span> <br> {{ $admin->alamat }}</p>
                            <p class="mt-10"><span class="font-bold ">Devisi :</span> <br> {{ $admin->devisi->nama_devisi }}</p>
                            <p class="mt-10"> <span class="font-bold ">No.Telp :</span> <br> {{ $admin->no_telp }}</p>

                          
                        </div>
                  
                </div>

                <div class="flex mt-10 w-full justify-center">

                    <a href="{{route('profile.edit', $admin->nip)}}"
                        class="ml-5 text-lg laptop:text-sm bg-white  w-40 h-10 laptop:w-24 laptop:h-10 rounded-full text-primary font-semibold flex items-center justify-center hover-white shadow-3xl">
                        <iconify-icon icon="akar-icons:edit" class="mr-3"></iconify-icon>
                        edit</a>

                        <a href="/admin/users/{{auth()->user()->id}}/change-password"
                            class="ml-5 text-lg laptop:text-sm bg-white  px-3 laptop:w-24 laptop:h-10 rounded-full text-primary font-semibold flex items-center justify-center hover-white shadow-3xl">
                            <iconify-icon icon="akar-icons:edit" class="mr-3"></iconify-icon>
                            passsword</a>

                </div>

            </div>
        </div>
    </div>



    <div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-80 z-50 hidden" id="confirmationContainer">
        <div id="confirmationDialog"
            class="flex flex-col justify-between fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-primary text-white w-11/12 md:w-2/3 lg:w-2/5 xl:w-2/6 h-52 p-6 rounded-lg shadow-lg z-60">
            <p class="text-lg">Apakah Anda yakin ingin menghapus data ini?</p>
            <div class="flex justify-evenly">
                <button class="w-1/2 h-10 hover-white bg-white text-primary  mr-2 rounded"
                    onclick="proceedDelete()">Ya</button>
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
            typeSpeed: 50,
            backSpeed: 25,
            backDelay: 1000,
            loop: false
        };

        var typed = new Typed("#typed-output", options);
    });
</script>
