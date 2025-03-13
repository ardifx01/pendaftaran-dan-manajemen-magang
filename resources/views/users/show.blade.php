@extends('layouts/main')

@section('container')
    <div class="w-full h-screen bg-myBg flex justify-beetwen md:items-center font-poppins">

       <div class="tablet:hidden">
        @include('/layouts/navApp')
    </div>

        <div class="container flex flex-col mx-auto ">

                <div class="flex items-center bg-primary rounded-3xl shadow-3xl mx-auto text-white w-2/4 p-10 justify-between animate__animated animate__fadeInRight">

                    <a href="{{route('users.index')}}"
                        class="flex items-center justify-center w-16 h-16 bg-white text-primary text-3xl rounded-full hover-white shadow-3xl tablet:hidden">
                        <iconify-icon icon="teenyicons:left-solid"></iconify-icon>
                    </a>

                    <div class="ml-10">
                 
                      
                  
                        <div class="mt-5 text-lg">
                            <p class="mt-1"><span class="bold-label">name </span>: {{ $user->name }}</p>
                            <p class="mt-1"><span class="bold-label">Email </span>: {{ $user->email }}</p>
                            <p class="mt-1"><span class="bold-label">Role </span>: {{ $user->role }}</p>
                           
                        </div>              
                </div>

                <div class="mt-10">
                    <a href="/admin/users/{{$user->id}}/change-password"
                        class="px-4 py-2 text-sm laptop:text-sm bg-white rounded-full text-primary font-semibold flex items-center justify-center hover-blue shadow-3xl">
                        <iconify-icon icon="akar-icons:edit" class="mr-3"></iconify-icon>
                        passsword</a>


                    

                                
                        <form  id="deleteForm" action="{{ route('users.destroy', $user->id) }}" method="POST" class="mt-5 px-4 py-2 text-sm laptop:text-sm bg-red-500 rounded-full text-white font-semibold flex items-center justify-center hover-white shadow-3xl 
                            @if($user->role === 'super') hidden @endif">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="showConfirmationDialog(event)">
                                <iconify-icon icon="akar-icons:edit" class="mr-3"></iconify-icon>
                                Hapus
                            </button>

                            
                        </form>
                        
                        
                    </div>               
            </div>         
        </div>

            {{-- confirm delete --}}
    <div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-80 z-50 hidden " id="confirmationContainer">
        <div id="confirmationDialog"
            class="flex flex-col justify-between fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-primary text-white w-11/12 md:w-2/3 lg:w-2/5 xl:w-2/6 h-52 p-6 rounded-lg shadow-lg z-60 ">
            <p class="text-lg">Apakah Anda yakin ingin menghapus data dari {{ $user->name }}?</p>
            <div class="flex justify-evenly">
                <button class="w-1/2 h-10 hover-white bg-white text-primary  mr-2 rounded"
                    onclick="proceedDelete()">Ya</button>
                <button class="w-1/2 h-10 hover-white bg-white text-primary rounded" onclick="cancelDelete()">Batal</button>
            </div>
        </div>
    </div>

    @endsection
