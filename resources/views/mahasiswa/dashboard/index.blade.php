@extends('layouts/main')

@section('container')
    <div class="w-full xl:h-screen bg-myBg flex items-center font-poppins laptop:flex-col">


        @include('/layouts/mahasiswaNav')


        {{-- ------------------------------------- --}}
        {{-- main --}}

        <div class="w-full xl:flex items-center z-10">

            <div
                class="xl:w-3/5 xxl:w-3/4 xxl:h-90% flex flex-col justify-between items-center phone:w-full phone:p-5 px-10">

                <div
                    class="w-full my-gradient rounded-3xl laptop:rounded-none shadow-3xl justify-between  text-white overflow-hidden flex h-60 sm:h-72 xxl:h-96 p-12 animate__animated animate__fadeInDown">

                    <div class="w-2/3 flex flex-col justify-between">

                        <div
                            class=" w-80 h-12  tablet:w-72 tablet:h-10 items-center bg-white bg-opacity-25 flex justify-between px-5 rounded-full font-semibold text-sm ">
                            <iconify-icon icon="uis:calender"></iconify-icon>
                            <p id="tanggal"></p>
                            <p id="jam" class="ml-4"></p>
                        </div>


                        <div>

                            @php
                                date_default_timezone_set('Asia/Jakarta');
                                $currentHour = date('H');
                                $greeting = '';

                                if ($currentHour >= 5 && $currentHour < 12) {
                                    $greeting = 'Selamat Pagi';
                                } elseif ($currentHour >= 12 && $currentHour < 15) {
                                    $greeting = 'Selamat Siang';
                                } elseif ($currentHour >= 15 && $currentHour < 18) {
                                    $greeting = 'Selamat Sore';
                                } else {
                                    $greeting = 'Selamat Malam';
                                }
                            @endphp

                            <h1 class="text-4xl font-bold mb-3 phone:text-2xl">
                                {{ $greeting }}, <br>
                                <span id="typed-output"></span>


                            </h1>


                            <div class="text-xl">
                                @php
                                    date_default_timezone_set('Asia/Jakarta');
                                    $currentDay = date('l');
                                    $greeting = 'Have a nice ' . $currentDay . '!';
                                @endphp

                                <h1 class="text-2xl phone:text-lg">{{ $greeting }}</h1>
                            </div>

                        </div>
                    </div>

                    <div class="w-2/5 phone:w-60 phone:mt-10">
                        <img src="{{ asset('img/img-dashboard.png') }}" alt="dashboard img" class="w-60  mx-auto">
                    </div>
                </div>

                <div
                    class="mt-10 w-full h-45% md:flex  justify-between extra:flex-wrap animate__animated animate__fadeInUp">

                    <div
                        class="phone:h-56  bg-medium text-slate-400 rounded-3xl text-center shadow-3xl flex flex-col justify-between  p-8 lg:w-45% md:w-full laptop:px-12 phone:p-4 xxl:w-2/4 xxl:h-80">
                        <h1 class="text-2xl font-bold "> Absensi Saya</h1>
                        <div class="w-full flex items-center justify-around ">
                            <iconify-icon icon="bi:people-fill"
                                class="phone:text-7xl font-extrabold text-red-600 text-9xl "></iconify-icon>
                            <div>
                                <div class="text-center">
                                    <h1 class="phone:text-4xl font-extrabold text-5xl">{{ $jmlAbsensi }}</h1>
                                    <p class="phone:text-md text-lg">Absen</p>
                                </div>
                            </div>
                        </div>
                        <a href='/mahasiswa/absensi-mahasiswa'
                            class="mt-5 px-5 py-2 text-white text-lg bg-red-600 rounded-full font-bold shadow-3xl hover:bg-transparent hover:border-red-600 hover:border-2 hover:text-red-600 hover:scale-107  transition duration-200 ease-in-out">
                            Detail</a>
                    </div>

         

                    <div
                        class=" bg-medium text-slate-400 rounded-3xl text-center shadow-3xl flex flex-col justify-between extra:w-full p-8 extra:mt-10 laptop:px-12 phone:p-4 phone:h-56 xl:w-1/3 xxl:w-2/4 xxl:h-80 ml-10">
                        <h1 class="text-2xl font-bold "> Jurnal Saya</h1>
                        <div class="w-full flex items-center justify-around ">
                            <iconify-icon icon="clarity:list-solid"
                                class="text-9xl font-extrabold text-blue-600 phone:text-7xl"></iconify-icon>
                            <div>
                                <div class="text-center">
                                    <h1 class="text-5xl font-extrabold phone:text-4xl ">{{ $jmlJurnal }}</h1>
                                    <p class="text-lg phone:-text-sm">Kegiatan</p>
                                </div>
                            </div>
                        </div>
                        <a href="/mahasiswa/jurnal"
                            class="mt-5 px-5 py-2 text-white text-lg bg-blue-600 rounded-full font-bold shadow-3xl hover:bg-transparent hover:border-blue-600 hover:border-2 hover:text-blue-600 hover:scale-107  transition duration-200 ease-in-out">
                            Detail
                        </a>
                    </div>
                </div>
            </div>

            <div class=" xl:w-2/5 flex-col flex h-250 justify-between p-5 animate__animated animate__fadeInRight">

                <div class="flex flex-col mt-5 w-full bg-medium h-64 rounded-3xl shadow-3xl items-center">
                    <div
                        class="w-full  h-20 bg-primary rounded-xl py-5 flex  items-center justify-between px-8 shadow-3xl phone:h-16 text-white">
                        <h1 class="text-2xl font-extrabold phone:text-xl">My Profile</h1>

                        <a href="{{route('profile-mahasiswa.index')}}" class=" bg-white text-primary px-6 py-2 rounded-full shadow-3xl hover-white">Detail</a>

                    </div>

                    <div class="flex w-11/12 mx-auto h-full items-center">

                        @if(auth()->user()->mahasiswa->image)
                        <img src="{{ asset('storage/'.auth()->user()->mahasiswa->image) }}"
                      
                            class="w-28 h-28 object-cover object-center rounded-full bg-white mr-4">
                    @else
                        <img src="https://source.unsplash.com/500x400/?profile" alt=""
                            class="w-20 h-20 object-cover object-center rounded-full  mr-4">
                    @endif

                        <div class="ml-10 xxl:mt-5 text-white">

                            <h1 class="text-4xl font-bold  ">
                                {{ auth()->user()->name }}
                            </h1>

                            <h3 class="text-xl mt-3">
                                {{ auth()->user()->role }}
                            </h3>

                        </div>
                    </div>
                </div>


                <div
                    class="w-full h-128 desktop:p-10 my-gradient rounded-3xl overflow-hidden mt-10 phone:p-2 phone:h-96 items-center justify-center p-5 text-whie">
                    <div id='calendar' class="overflow-y-auto w-full mx-auto mt-5 h-96 desktop:w-full text-white"></div>
                </div>


            </div>
        </div>
    @endsection
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

    <!--Typed.js -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                strings: ["{{ auth()->user()->name }}"],
                typeSpeed: 200,
                backSpeed: 25,
                backDelay: 1000,
                loop: false
            };

            var typed = new Typed("#typed-output", options);
        });
    </script>


    {{-- my calender --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                views: {
                    dayGridMonth: {
                        duration: {
                            months: 1
                        }
                    }
                },
                locale: 'id',

                buttonText: {
                    today: 'Hari Ini'
                }
            });
            calendar.render();
        });
    </script>

    <script>
        function updateClock() {
            var now = new Date();

            var optionsTanggal = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            var formattedTanggal = now.toLocaleDateString('id-ID', optionsTanggal);

            var optionsJam = {
                hour: '2-digit',
                minute: '2-digit',
                timeZoneName: 'short'
            };
            var formattedJam = now.toLocaleTimeString('id-ID', optionsJam);

            document.getElementById('tanggal').innerText = formattedTanggal;
            document.getElementById('jam').innerText = formattedJam;

        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>
