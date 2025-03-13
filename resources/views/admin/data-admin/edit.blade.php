@extends('layouts/main')
@section('container')
<div class="w-full h-screen bg-myBg flex items-center font-poppins laptop:flex-col">
    @include('/layouts/navApp')
        <div class=" desktop:w-full flex flex-col mx-auto bg-medium rounded-3xl  shadow-3xl px-5">

            <div class="mt-5 h-28 bg-primary text-center flex items-center rounded-3xl px-10">
                <a href="{{route('data-admin.show',$admin->nip)}}"
                    class="flex items-center justify-center w-20 h-20 bg-white text-primary text-4xl rounded-full hover-white shadow-3xl">
                    <iconify-icon icon="teenyicons:left-solid"></iconify-icon>
                </a>
                <h1 class="ml-10 text-4xl laptop:text-3xl font-bold text-white ">Edit Data Admin</h1>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border mt-5 border-red-400 text-red-700 px-4 py-3 rounded flex items-center relative "
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

            <form action="{{route('data-admin.update',$admin->nip)}}" method="post" enctype="multipart/form-data"
                class="flex flex-col text-white mt-5 w-full max-w-screen-md px-10 py-5 mx-auto">
              @method('put')
                @csrf
             
                
                        <input type="number" id="nip" name="nip"  required
                            class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500"
                            value="{{ old('nip', $admin->nip) }}">

                        <input type="text" id="nama" name="nama" placeholder="Nama" required
                            class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500"
                            value="{{ old('nama', $admin->nama) }}">

                        <input type="text" id="email" name="email" placeholder="Email" required
                            class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500"
                            value="{{ old('email', $admin->email) }}">

                            <input type="text" id="no_telp" name="no_telp" placeholder="no_telp" required
                            class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500"
                            value="{{ old('no_telp', $admin->no_telp) }}">

                        <input type="text" id="alamat" name="alamat" placeholder="Sekolah/Universitas"
                            required
                            class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500"
                            value="{{ old('alamat', $admin->alamat) }}" required >
                     

                            <label for="devisi_id">Devisi Pegawai</label>
                            <select name="devisi_id" id="devisi_id"
                            class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500">
                            @foreach ($devisi as $data )
                                <option value="{{$data->id}}">{{$data->nama_devisi}}</option>
                            @endforeach
                            </select>

                       
                        <textarea id="alamat" name="alamat" placeholder="Alamat" required
                            class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500" rows="4">{{ old('alamat', $admin->alamat) }}</textarea>
               

               {{-- old image --}}
               <input type="hidden" name="oldImage" id="oldImage" value="{{$admin->image}}">

                <label for="image" class="mb-2 ">Foto Mahasiswa : </label> <br>
                <input type="file" name="image" id="image"
                    class="laptop:w-full text-slate-800 bg-white mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary">

                <button type="submit"
                    class="mt-10 bg-primary text-white px-6 py-3 rounded-md 0 focus:outline-none focus:shadow-outline-primary hover-primary">Update</button>
            </form>
        </div>
    </div>
@endsection


