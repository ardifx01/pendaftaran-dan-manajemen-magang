<!-- admin.absensi.create.blade.php -->
@extends('layouts/main')

@section('container')
    <div class="w-full h-screen bg-myBg flex items-center tablet:px-5 ">

        
            @include('/layouts/navApp')
  

        <div class="w-full lg:w-2/4 xl:w-2/5 flex flex-col mx-auto bg-medium rounded-3xl  shadow-3xl p-10">

            <div
                class=" bg-primary px-10 py-10 tablet:py-5 flex justify-center items-center rounded-3xl shadow-3xl w-full mx-auto">

                <h1 class="text-4xl phone:text-2xl font-bold  text-white">Tambah User Mahasiswa</h1>
            </div>



            <form action="{{route('users.store')}}" method="post" class="flex flex-col text-white mt-5 w-full mx-auto">
                @csrf

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


                <input type="hidden" name="role" value="mahasiswa">

                <label for="mahasiswa_id" class="mb-2">NIM/NISN :</label>
                <input type="text" name="mahasiswa_id" id="mahasiswa_id"
                    class="text-slate-800  mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary"
                     value="{{ old('mahasiswa_id') }}">


                     <label for="password" class="mb-2">Password :</label>
                     <div class="relative">
                         <input type="password" name="password" id="password" class="w-full text-slate-800 mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary">
                         <span id="togglePassword" class="absolute top-0 right-0 mt-2 mr-4 cursor-pointer">
                             <iconify-icon id="eyeIcon" icon="bi:eye-fill" class="text-2xl text-slate-800"></iconify-icon>
                         </span>
                     </div>


                <!-- Button submit -->
                <button type="submit"
                    class="mt-10 bg-primary text-white px-6 py-3 rounded-md hover:bg-opacity-90 focus:outline-none focus:shadow-outline-primary">Register</button>
            </form>


            <div class=" p-5 flex justify-center items-center w-full mx-auto">
            </div>
        </div>


    </div>


    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var eyeIcon = document.getElementById('eyeIcon');
    
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('icon', 'bi:eye-slash-fill');
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('icon', 'bi:eye-fill');
            }
        });
    </script>
@endsection
