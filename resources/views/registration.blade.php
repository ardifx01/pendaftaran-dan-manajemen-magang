@extends('layouts/main')

@section('container')
    <div class="w-full h-screen bg-myBg flex items-center font-poppins laptop:flex-col">
       
        <div class=" desktop:w-full flex flex-col mx-auto bg-medium rounded-3xl  shadow-3xl px-5">

            <div class="mt-5 h-28 bg-primary text-center flex items-center rounded-3xl px-5">
                <a href="/admin/mahasiswa"
                    class="flex items-center justify-center w-20 h-20 bg-white text-primary text-4xl rounded-full hover-white shadow-3xl">
                    <iconify-icon icon="teenyicons:left-solid"></iconify-icon>
                </a>
                <h1 class="ml-10 text-5xl laptop:text-3xl font-bold text-white ">Pendaftaran</h1>
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

            <form action="{{route('registration.submit')}}" method="post" enctype="multipart/form-data"
                class="flex flex-col text-white mt-5 w-full max-w-screen-md p-10 mx-auto">
                @csrf
                <div class="flex laptop:flex-col  ">
                    <div>
                        <input type="number" id="nim_nisn" name="nim_nisn" placeholder="Nim/Nisn" required
                            class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-800"
                            value="{{old('nim_nisn')}}">

                        <input type="text" id="nama" name="nama" placeholder="Nama" required
                            class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-800"
                            value="{{old('nama')}}">

                        <input type="email" id="email" name="email" placeholder="Email" required
                            class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-800"
                            value="{{old('email')}}">

                        <input type="text" id="sekolah_univ" name="sekolah_univ" placeholder="Sekolah/Universitas"
                            required
                            class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-800"
                            value="{{old('sekolah_univ')}}">
                            
                        <input type="text" id="jurusan" name="jurusan" placeholder="Jurusan" required
                            class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-800"
                            value="{{old('jurusan')}}">
                            

                        <textarea id="alamat" name="alamat" placeholder="Alamat" required
                            class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-800">{{old('alamat')}}</textarea>
                    </div>

                    <div>
                        <input type="text" id="no_telp" name="no_telp" placeholder="No.Telp Mahasiswa" required
                            class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-800"
                            value="{{old('no_telp')}}">

                        <input type="text" id="no_guru" name="no_guru" placeholder="No.Guru" required
                            class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-800"
                            value="{{old('no_guru')}}">

                        <p class="font-bold p">format : bulan/hari/tahun</p>


                        <label for="tanggal_masuk" class="mb-2">Tanggal Masuk : </label><br>
                        <input type="date" name="tanggal_masuk" id="tanggal_masuk"
                            class="laptop:w-full text-slate-800 mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary"
                            required><br>


                        <label for="tanggal_keluar" class="mb-2 ">Tanggal Keluar : </label> <br>
                        <input type="date" name="tanggal_keluar" id="tanggal_keluar"
                            class="laptop:w-full text-slate-800  mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary"
                            required><br>



                    </div>

                </div>

                <label for="image" class="mb-2 ">Foto Anda : </label> <br>
                        <input type="file" name="image" id="image"
                            class="laptop:w-full bg-white text-slate-800  mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary"
                            required><br>

                <button type="submit"
                    class="mt-10 bg-primary text-white px-6 py-3 rounded-md 0 focus:outline-none focus:shadow-outline-primary hover-primary">Submit</button>
            </form>

        </div>
    </div>


   

  
    @if (session()->has('success'))
    <div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-80 z-50">
        <div class="flex flex-col justify-between fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-primary text-white w-11/12 md:w-2/3 lg:w-2/5 xl:w-2/6 h-52 p-6 rounded-lg shadow-lg z-60" id="successMessage">
            <p class="text-lg">{{ session('success') }}</p>
            <div class="flex justify-evenly">
                <button class="w-1/2 h-10 hover-white bg-white text-primary  mr-2 rounded" >
                   <a href="/">Oke</a> 
                </button>
            </div>
        </div>
    </div>
    @endif

@endsection

<script>
    function hideSuccessMessage() {
        var successMessage = document.getElementById('successMessage');
        successMessage.style.display = 'none';
    }
</script>
