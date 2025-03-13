@extends('layouts/main')
@section('container')
    <div class="w-full h-screen bg-myBg flex items-center font-poppins laptop:flex-col">
        @include('/layouts/navApp')

        <div class="p-5 w-9/12 laptop:w-full  mx-auto">

            <div class=" bg-medium w-full h-250 rounded-3xl shadow-3xl animate__animated animate__fadeInUp ">

                {{-- header --}}
                <div
                    class=" w-full py-5 px-10 items-center my-gradient rounded-3xl laptop:rounded-none shadow-3xl tablet:px-5">
                    <div class="flex items-center w-full justify-evenly sm:justify-between">
                        <h1 class="text-white text-5xl tablet:text-3xl font-bold tracking-widest">
                            <span id="typed-output"></span>
                        </h1>
                    </div>

                    <div class="mt-10 tablet:mt-5 flex justify-between laptop:flex-col">
                              {{-- search --}}
                              <form action="{{route('data-admin.index')}}">   
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


                        <div class="flex flex-col">

                    <div class="flex">
                        <a href="{{ route('users.mahasiswa.create') }}"
                            class="mr-4 shadow-3xl text-sm bg-white h-12 w-40 phone:ml-3 rounded-full text-primary flex items-center justify-center hover-white">
                            <iconify-icon icon="zondicons:add-solid" class="mr-2 text-xl"></iconify-icon>
                            Mahasiswa

                            @auth
                                @if (auth()->user()->role === 'super')
                                    <a href="{{ route('users.admin.create') }}"
                                        class="shadow-3xl text-sm bg-white h-12 w-40 phone:ml-3 rounded-full text-primary flex items-center justify-center hover-white">
                                        <iconify-icon icon="zondicons:add-solid" class="mr-2 text-xl"></iconify-icon>
                                        admin
                                    </a>
                                @else
                                    <a href="/"
                                        class="shadow-3xl text-sm bg-white h-12 w-40 phone:ml-3 rounded-full text-primary flex items-center justify-center hover-white"
                                        id="userLink">
                                        <iconify-icon icon="zondicons:add-solid" class="mr-2 text-xl"></iconify-icon>
                                        admin
                                    </a>
                                @endif

                            @endauth
                        </div>

                        <div class="flex justify-center ">
                            {{ $users->links() }}
                        </div>
                    </div>
                    </div>
                </div>



                {{-- content --}}
                <div class="mx-auto mt-10 h-2/3 w-11/12 overflow-auto ">
                    <ul role="list">
                        @foreach ($users as $user)
                            <li
                                class="group/item hover:bg-slate-700 flex justify-between px-10  py-3 items-center text-white border-0 border-slate-500 border-b-2 tablet:px-2">

                                <div class="flex items-center animate__animated animate__fadeInLeft">


                                    <div class="flex flex-col justify-center  w-full ">
                                        <h1 class="text-xl font-bold tablet:text-lg">{{ $user->name }}</h1>
                                        <h3 class="text-lg tablet:text-sm">{{ $user->role }}</h3>
                                    </div>

                                </div>


                                @auth
                                @if (auth()->user()->role === 'super')
                                    <a class="group/edit invisible hover:bg-primary hover:shadow-3xl group-hover/item:visible w-28 h-10 tablet:w-16 rounded-full flex items-center justify-center tablet:hidden"
                                    @if($user->role === "admin" )       
                                    href="{{ route('users.show', $user->id) }}"

                                    @elseif($user->role === "super")
                                    href="{{ route('users.show', $user->id) }}"

                                    @elseif($user->role === "mahasiswa")
                                    href="{{ route('users.mahasiswa.show', $user->id) }}"
                                    @endif >
                                        <span class="group-hover/edit:text-white tablet:text-sm">Detail</span>
                                        <iconify-icon icon="mdi:pan-right"
                                            class="text-4xl tablet:text-2xl tablet:hidden"></iconify-icon>
                                    </a>

                                @elseif (auth()->user()->role === 'admin')
                                    @if ($user->role === 'mahasiswa')
                                        <a class="group/edit invisible hover:bg-primary hover:shadow-3xl group-hover/item:visible w-28 h-10 tablet:w-16 rounded-full flex items-center justify-center tablet:hidden"
                                            href="{{ route('users.mahasiswa.show', $user->id) }}">
                                            <span class="group-hover/edit:text-white tablet:text-sm">Detail</span>
                                            <iconify-icon icon="mdi:pan-right"
                                                class="text-4xl tablet:text-2xl tablet:hidden"></iconify-icon>
                                        </a>
                                    @else
                                        <p>Tidak Memiliki Akses</p>
                                    @endif
                                @endif
                            @endauth
                            


                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->



    {{-- error massage --}}

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

    {{-- my script --}}
@endsection

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelector('#userLink').addEventListener('click', function(e) {
                e.preventDefault();


                Swal.fire({
                    icon: 'error',
                    title: 'Akses Ditolak',
                    text: 'Anda tidak memiliki izin untuk mengakses halaman ini.',
                    showCancelButton: false,
                    confirmButtonText: 'Ok'
                });
            });
        });
    </script>


<!--Typed.js -->
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            strings: ["Data Users"],
            typeSpeed: 70,
            backSpeed: 25,
            backDelay: 1000,
            loop: false
        };

        var typed = new Typed("#typed-output", options);
    });
</script>
