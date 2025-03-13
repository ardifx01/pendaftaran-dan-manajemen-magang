<!-- admin.absensi.create.blade.php -->
@extends('layouts/main')

@section('container')
    <div class="w-full h-screen bg-myBg flex items-center">

        <div class="tablet:hidden">
        @include('/layouts/mahasiswaNav')
    </div>

        <div class="w-1/2 desktop:w-full flex flex-col mx-auto bg-medium rounded-3xl p-20 tablet:p-8 shadow-3xl">



            <form action="{{route('absensi-mahasiswa.store')}}" method="post" class="flex flex-col w-full text-white mt-10  mx-auto">
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



                <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->nim_nisn }}">
                <input type="date" name="tanggal" id="tanggal" value="{{ now()->format('Y-m-d') }}" class="text-slate-800">
                 
                

                <label for="status" class="mb-2">Status :</label>
                <select name="status" id="status"
                    class="mb-4 px-4 py-2 text-slate-800 rounded-md border border-gray-300 focus:outline-none focus:border-primary">
                    <option value="hadir">Hadir</option>
                    <option value="tidak_hadir">Tidak Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                </select>

             

             
              


                <button type="submit"
                    class="text-xl font-bold mt-10 bg-primary text-white px-6 py-3 rounded-md focus:outline-none hover-primary">Absen</button>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil tanggal dari elemen dengan id "tanggal"
            var tanggalInput = document.getElementById('tanggal');

            // Hitung nama hari dari tanggal hari ini
            var hari = new Date().toLocaleDateString('id-ID', {
                weekday: 'long'
            });

            // Set nilai input hidden "hari" dengan hari ini
            document.getElementById('hari').value = hari;

            // Tambahkan event listener untuk memperbarui input hidden jika tanggal berubah
            tanggalInput.addEventListener('change', function() {
                var tanggal = this.value;

                // Hitung nama hari dari tanggal yang dipilih
                var hari = new Date(tanggal).toLocaleDateString('id-ID', {
                    weekday: 'long'
                });

                // Isi nilai input hidden "hari"
                document.getElementById('hari').value = hari;
            });
        });
    </script>
@endsection
