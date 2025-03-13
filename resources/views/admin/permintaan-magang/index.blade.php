@extends('layouts/main')
@section('container')

<div class="w-full h-screen bg-myBg flex items-center font-poppins laptop:flex-col">
    @include('/layouts/navApp')
        
    
    <div class="p-5 w-9/12 laptop:w-full  mx-auto ">
    
        <div class=" bg-medium w-full h-250 rounded-3xl shadow-3xl">
                <div class="flex tablet:flex-col justify-between p-10 tablet:p-5 w-full my-gradient rounded-3xl tablet:rounded-none shadow-3xl tablet:px-5">
                    <h1 class="text-white text-5xl tablet:text-4xl font-bold tracking-wides" >
                        <span id="typed-output"></span>
                    </h1>
                    <div class="w-1/3 tablet:w-full tablet:mt-5">
                   
                    </div>
                </div>

       
                <div class="mx-auto mt-10 h-2/3 w-11/12 overflow-auto">
                    <ul role="list">
                        @foreach ($permintaan as $data)
                            <a href="{{route('permintaan-magang.show',$data->nim_nisn)}}">
    
                                <li
                                    class="group/item hover:bg-slate-700 flex justify-between px-10  py-3 items-center text-white border-0 border-slate-500 border-b-2 tablet:px-2">
    
                                    <div class="flex items-center animate__animated animate__fadeInLeft">

                                        @if($data->image)
                                        <img src="{{ asset('storage/'.$data->image) }}"
                                      
                                            class="w-20 h-20 object-cover object-center rounded-full mr-4">
                                    @else
                                        <img src="https://source.unsplash.com/500x400/?profile" alt=""
                                            class="w-20 h-20 object-cover object-center rounded-full bg-white mr-4">
                                    @endif

                                            
    
                                        <div class="flex flex-col justify-center ml-3 lg:ml-10  ">
                                            <h1 class="text-xl font-bold tablet:text-lg">{{ $data->nama }}</h1>
                                            <h3 class="text-lg tablet:text-sm">{{ $data->sekolah_univ }}</h3>
                                        </div>
    
                                    </div>
    
                                    <a class="group/edit invisible hover:bg-primary hover:shadow-3xl  group-hover/item:visible w-28 h-10 tablet:w-16 rounded-full flex items-center justify-center tablet:hidden"
                                        href="{{route('permintaan-magang.show',$data->nim_nisn)}}">
                                        <span class="group-hover/edit:text-white  tablet:text-sm">Detail</span>
                                        <iconify-icon icon="mdi:pan-right"
                                            class="text-4xl tablet:text-2xl tablet:hidden"></iconify-icon>
                                    </a>
                                </li>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

<!--Typed.js -->
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            strings: ["Permintaan Magang"],
            typeSpeed: 50,
            backSpeed: 25,
            backDelay: 1000,
            loop: false
        };

        var typed = new Typed("#typed-output", options);
    });
</script>

