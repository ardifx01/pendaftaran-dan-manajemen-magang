<!-- resources/views/admin/absensi/show.blade.php -->

@extends('layouts.main')
@section('container')
    <div class="w-full h-screen bg-myBg flex items-center font-poppins laptop:flex-col">
        @include('/layouts/navApp')
        <div class="p-5 w-9/12 laptop:w-full  mx-auto ">
            <div class=" bg-medium w-full h-250 rounded-3xl shadow-3xl">

                {{-- header --}}
                <div class="w-full my-gradient flex items-center rounded-3xl tablet:rounded-none shadow-3xl py-5">

                    {{-- image --}}
                    <img 
                    @if ($mahasiswa->image) 
                    src="{{ asset('storage/' . $mahasiswa->image) }}"
                       @else
                          src="https://source.unsplash.com/500x400/?profile" 
                    @endif
                        class="ml-10 w-24 h-24 lg:w-40 lg:h-40 rounded-full object-cover object-center shadow-3xl">
                        {{-- end image --}}


                    <div class="ml-20 laptop:ml-10 h-full flex flex-col justify-center text-white">
                        <h1 class="text-lg sm:text-2xl lg:text-4xl font-bold tracking-wider">{{ $mahasiswa->nama }}</h1>
                        <h3 class="text-md  lg:text-2xl tracking-wider mt-2">{{ $mahasiswa->sekolah_univ }}</h3>


                        <div class="flex justify-between phone:justify-evenly">
                            <a href="/admin/absensi/"
                                class="mt-5 bg-white h-12 w-12 phone:h-10 phone:w-10 rounded-full text-primary shadow-3xl flex items-center justify-center hover:scale-105 hover-white">
                                <iconify-icon icon="teenyicons:left-solid" class="mr-2 text-2xl"></iconify-icon>
                            </a>
                            <a href="/admin/absensi/create/{{ $mahasiswa->nim_nisn }}"
                                class="mt-5 text-md phone:text-sm bg-white h-12 w-40 phone:h-10 phone:w-28 rounded-full text-primary shadow-3xl flex items-center justify-center hover:scale-105 hover-white">
                                <iconify-icon icon="zondicons:add-solid" class="mr-2 text-xl"></iconify-icon>
                                Absen
                            </a>
                        </div>
                    </div>
                </div>
                {{-- header end --}}


                <div class="mx-auto h-2/3 w-11/12 mt-10 overflow-auto animate__animated animate__fadeInUp">


                    @if ($absensi->count() > 0)
                        <table class="text-center w-full border border-collapse text-white" cellspacing="0">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="border p-2">No.</th>
                                    <th class="border p-2">Tanggal</th>
                                    <th class="border p-2">Status</th>
                                    <th class="border p-2 w-1/5">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensi as $absensiItem)
                                    <tr>
                                        <td class="border p-2">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="border p-2">
                                            {{ \Carbon\Carbon::parse($absensiItem->tanggal)->translatedFormat('d F Y') }}
                                        </td>

                                        <td class="border p-2">{{ $absensiItem->status }}</td>

                                        <td class="border p-2 ">
                                            <div class="flex justify-center">
                                                <form action="/admin/absensi/{{ $absensiItem->id }}" method="post"
                                                    id="deleteForm">
                                                    @method('delete')
                                                    @csrf
                                                    <button onclick="showConfirmationDialog(event)"
                                                        class="mr-3 h-10 w-10 bg-red-500  hover:bg-red-700">
                                                        <iconify-icon icon="zondicons:trash"></iconify-icon>
                                                    </button>
                                                </form>

                                                <a href="{{ route('admin.absensi.edit', $absensiItem->id) }}"
                                                    class="mr-3 h-10 w-10 bg-yellow-400  hover:bg-yellow-600 items-center flex justify-center">
                                                    <iconify-icon icon="akar-icons:edit"></iconify-icon>
                                                </a>

                                                <button id="showBtn_{{ $absensiItem->id }}"
                                                    onclick="showAbsensi('{{ $absensiItem->id }}')"
                                                    class="mr-3 w-10 h-10 bg-green-400  hover:bg-green-500">
                                                    <span id="iconBtn_{{ $absensiItem->id }}">
                                                        <iconify-icon icon="icon-park-solid:down-two"></iconify-icon>
                                                    </span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- responsive  --}}
                                    <tr id="absensiDropDown_{{ $absensiItem->id }}" class="animate__animated hidden">
                                        <td colspan="4">
                                            <div class="flex flex-col items-start p-3 w-full bg-slate-900">
                                                <div class="flex">
                                                    <div class="text-left">
                                                        <p>keterangan </p>
                                                        <p>Hari </p>
                                                        <p>Jam </p>
                                                    </div>
                                                    <div class="text-left ml-3">
                                                        <p>: {{ $absensiItem->keterangan }}</p>
                                                        <p>: {{ $absensiItem->hari }}</p>
                                                        <p>: {{ \Carbon\Carbon::parse($absensiItem->jam)->translatedFormat('H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- ----------------------------- --}}
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-2xl mt-10 text-center text-white"> Absensi Tidak Di Temukan.</p>
                    @endif
                </div>
            </div>
        </div>

    </div>

    {{-- confirm delete --}}
    <div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-80 z-50 hidden" id="confirmationContainer">
        <div id="confirmationDialog"
            class="flex flex-col justify-between fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-primary text-white w-11/12 md:w-2/3 lg:w-2/5 xl:w-2/6 h-52 p-6 rounded-lg shadow-lg z-60">
            <p class="text-lg">Apakah Anda yakin ingin menghapus data dari {{ $mahasiswa->nama }}?</p>
            <div class="flex justify-evenly">
                <button class="w-1/2 h-10 hover-white bg-white text-primary  mr-2 rounded"
                    onclick="proceedDelete()">Ya</button>
                <button class="w-1/2 h-10 hover-white bg-white text-primary rounded" onclick="cancelDelete()">Batal</button>
            </div>
        </div>
    </div>

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

@endsection

<script>
    function showAbsensi(id) {
        var absensi = document.getElementById('absensiDropDown_' + id);
        var btn = document.getElementById('showBtn_' + id);
        var icon = document.getElementById('iconBtn_' + id);

        if (absensi.classList.contains('hidden')) {
            absensi.classList.remove('hidden');
            absensi.classList.add('animate__fadeInDown');
            icon.innerHTML = '<iconify-icon icon="zondicons:close-outline"></iconify-icon>';
        } else {
            absensi.classList.add('animate__fadeOutUp');
            setTimeout(() => {
                absensi.classList.add('hidden');
                absensi.classList.remove('animate__fadeOutUp');
            }, 300);
            icon.innerHTML = '<iconify-icon icon="icon-park-solid:down-two"></iconify-icon>';
        }
    }
</script>
