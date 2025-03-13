@extends('layouts/main')
@section('container')

    <div class="w-full h-screen my-gradient flex justify-center font-poppins relative">
        <div class="w-128 h-2/4 bg-white bg-opacity-50 rounded-3xl text-white p-10 shadow-3xl mt-20">
            <h1 class="text-6xl font-bold text-center">Login</h1>

            <form action="" method="post" class="mt-14 w-full flex flex-col items-center">

                @if ($errors->any())
                    <div class="text-red-500 text-2xl py-5">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @csrf
                <div class="w-full max-w-md px-10">
                    <input
                        class="border-0 border-b-2 bg-transparent border-white focus:border-bg-primary outline-none py-3 text-xl transition-all duration-300 placeholder-white w-full"
                        type="text" name="email" placeholder="Email">
                    <input
                        class="mt-10 border-0 border-b-2 bg-transparent border-white focus:border-bg-primary outline-none py-3 text-xl transition-all duration-300 placeholder-white w-full"
                        type="password" name="password" id="password" placeholder="Password">

                </div>

                <button class="mt-10 my-btn bg-primary text-white px-10 py-3 rounded-3xl hover-white" role="button" type="submit">Login</button>
                <p class="mt-5 text-sm">Belum Punya Akun? <span class="text-primary "><a href="#">Daftar
                            Sekarang</a></span></p>
            </form>

        </div>


        <img src="{{ asset('img/login.png') }}" alt="" class="absolute bottom-0 w-2/6 ">
    </div>
