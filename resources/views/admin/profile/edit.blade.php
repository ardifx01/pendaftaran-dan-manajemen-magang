@extends('layouts/main')

@section('container')
    <div class="w-full h-screen bg-myBg flex items-center font-poppins ">
        @include('/layouts/navApp')

        <div class="w-2/4 flex flex-col mx-auto bg-medium rounded-3xl p-10 shadow-3xl">


            <div class="h-40 bg-primary text-center flex items-center rounded-3xl p-10">

                <a href="/admin/data-admin"
                    class="flex items-center justify-center w-20 h-20 bg-white text-primary text-4xl rounded-full hover-white shadow-3xl">
                    <iconify-icon icon="teenyicons:left-solid"></iconify-icon>
                </a>

                <h1 class="ml-10 text-5xl font-bold text-white ">{{$title}}</h1>
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

      
            <form action="{{route('profile.update',$admin->nip)}}" method="post" enctype="multipart/form-data"  class="flex flex-col text-white mt-10 w-full mx-auto p-10">
                @csrf
                @method('put')
                    

                        <input type="text" id="nip" name="nip" placeholder="NIP " required
                           
                            class="mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500"
                            value="{{ old('nip', $admin->nip )}}">

                            <input type="text" id="nama" name="nama" placeholder="Nama " required
                            class="mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500"
                            value="{{ old('nama', auth()->user()->admin->nama )}}">

                        <input type="email" id="email" name="email" placeholder="Email" required
                            class="mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500"
                            value="{{ old('email', auth()->user()->admin->email )}}">

                            <textarea id="alamat" name="alamat" placeholder="Alamat" required
                            class="mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500">{{ old('alamat',auth()->user()->admin->alamat )}}</textarea>


                        <input type="text" id="no_telp" name="no_telp" placeholder="No.Telp" required
                        class="mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500"
                        value="{{ old('no_telp', auth()->user()->admin->no_telp )}}">

                        <label for="devisi_id">Devisi Pegawai</label>
                        <select name="devisi_id" id="devisi_id"
                        class="laptop:w-full mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500">
                        @foreach ($devisi as $data )
                            <option value="{{$data->id}}">{{$data->nama_devisi}}</option>
                        @endforeach
                        </select>

                        <label for="image">Foto Admin</label>
                        <input type="file" id="image" name="image" placeholder="image"
                         
                            class=" bg-white mb-4 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:border-primary text-gray-500"
                            value="{{ old('image', auth()->user()->admin->image)}}">

                          

                <button type="submit"
                    class="mt-10 bg-primary text-white px-6 py-3 rounded-md 0 focus:outline-none focus:shadow-outline-primary hover-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
