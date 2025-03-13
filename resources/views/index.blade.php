@extends('layouts/main')
@section('container')

    <style>
        * {
            scroll-behavior: smooth;
        }

        #about {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('img/bg1.jpg') no-repeat;
            background-size: cover;
            background-attachment: fixed;
            /* Add this line for parallax effect */
            position: relative;
            overflow: hidden;
            /* Hide overflowing content */
        }
    </style>



    <div class="w-full font-poppins">
        {{-- nav --}}
        <div class="w-full bg-primary h-20 fixed justify-between flex items-center text-white z-50 px-10">

            <a href="/" class="text-2xl font-bold">Logo</a>

            <nav class="text-lg ">
                <a href="#home" class="mr-5 font-bold">Home</a>
                <a href="#about" class="mr-5 font-bold">About</a>
                <a href="#contact" class="mr-5 font-bold">Contact</a>

            </nav>
        </div>
        {{-- nav end --}}
        {{-- home start --}}
        <div id="home" class="w-full h-screen mx-auto flex desktop:flex-col-reverse items-center justify-around">

            <div class="content xl:w-2/5 lg:relative xl:ml-32">
                <h1
                    class=" text-8xl desktop:text-6xl font-bold text-center xl:text-left  mt-10  text-slate-800 leading-tight tracking-normal ">
                    <span class="text-white desktop:text-primary">Kantor</span> Wali <span id="typed-output"></span>
                </h1>

                <div class="text-center xl:text-left mt-10 ">

                    <p class=" text-2xl desktop:text-xl phone:px-5 text-slate-950">
                        Membuka pendaftaran bagi siswa/mahasiswa yang ingin mencari pengalaman magang
                    </p>

                    <div class="mt-10">
                        <a href="/registration"
                            class="px-14 py-3 bg-primary  shadow-3xl text-2xl font-bold text-white hover-primary">Daftar</a>
                        <a href="/login"
                            class="px-14 py-3 border-2 border-primary  shadow-3xl text-2xl font-bold text-primary ml-5 hover-blue">Login</a>

                    </div>

                    <div class="circle -z-10 desktop:hidden bg-primary shadow-3xl"></div>
                    <img src="img/bg2.png" class=" w-128 -z-20 absolute top-0 -left-28 desktop:hidden">


                </div>
            </div>

            <img src="img/home.png" class=" w-128 desktop:mt-10  xl:w-2/5 ">


        </div>
        {{-- home end --}}
        <div id="about" class="tablet:items-end">
            <div class="w-2/3 h-2/4 mx-auto laptop:w-full laptop:h-auto ">
                <h1 class="text-6xl font-bold mb-5 text-center text-white">About</h1>
                <div
                    class="relative bg-white w-full h-full rounded-3xl laptop:rounded-none shadow-3xl flex flex-col items-center justify-center px-20 desktop:p-5 text-slate-800 text-lg  text-center">
                    <p>Bangunan Kantor Walikota Langsa merupakan bangunan ex Kantor Bupati Aceh Timur yang sudah di hibahkan
                        kepada Pemerintah Kota Langsa dan di gunakan sebagai Kantor Walikota Langsa yang terletak di pusat
                        Kota merupakan bangunan lama yang masih dapat di pergunakan untuk kepentingan Pemerintah.</p>

                        <p id="paragraph" class="mt-3 hidden animate__animated animate__fadeInDown">
                            Saat ini kondisi bangunan di maksud dalam kata keadaan terawat dan berfungsi dengan baik, namun masih banyak terdapat beberapa fasilitas atau bagian dari bangunan tersebut dalam kondisi kurang memadai 	karena usang termakan usia, maka dari itu dalam upaya pemanfaatan bangunan sebagai bangunan pemerintah di pandang perlu untuk meningkatkan kondisi bangunan agar semakin baik dalam rangka menunjang aktifitas Pemerintah Kota Langsa.</p>

                    <button id="moreAbout"
                        class="font-bold absolute -bottom-20 flex flex-col items-center text-white text-2xl">
                        More
                        <iconify-icon id="icon" icon="mingcute:down-fill"></iconify-icon>
                    </button>

                </div>

            </div>
        </div>

        <div id="contact" class="w-full h-screen laptop:h-auto flex flex-col justify-evenly">
            <h1 class="text-6xl font-bold  text-center text-primary laptop:mt-10">Contact Us</h1>

            <div class="w-full  px-10 flex laptop:flex-col justify-around ">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3977.6870380540695!2d97.96388477588168!3d4.469145843619533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30379b2e5af637eb%3A0xaf201f071d96ff6a!2sKantor%20Walikota%20Langsa!5e0!3m2!1sid!2sid!4v1706072772249!5m2!1sid!2sid"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="w-45% laptop:w-full laptop:mt-10 rounded-3xl shadow-3xl"></iframe>

                <div class="w-45% laptop:w-full bg-primary p-10 rounded-3xl shadow-3xl laptop:mt-10 laptop:mb-10">
                    <form action="#">
                        <input type="text" class="py-3 px-5 w-full border rounded-lg text-slate-800 mb-3" placeholder="Name">
                        <input type="text" class="py-3 px-5 w-full border rounded-lg text-slate-800 mb-3" placeholder="Email">
                        <textarea name="" id="" rows="6" class="py-3 px-5 w-full border rounded-lg text-slate-800 mb-3" placeholder="Message"></textarea>
                        <button class="px-10 bg-white rounded-lg py-3 font-bold text-primary hover-blue">Send</button>
                    </form>
                </div>
            </div>
        </div>


       
        {{-- about end --}}

        <div class="w-full h-36 bg-primary flex flex-col items-center justify-center text-white text-lg font-bold">

            <div class="text-2xl border-b-2 w-auto mb-2">
            <iconify-icon icon="formkit:whatsapp"></iconify-icon>
            <iconify-icon icon="mdi:instagram"></iconify-icon>
            <iconify-icon icon="uil:linkedin"></iconify-icon>
            <iconify-icon icon="mdi:twitter"></iconify-icon>
            <iconify-icon icon="mdi:gmail"></iconify-icon>
            <iconify-icon icon="ic:baseline-tiktok"></iconify-icon>
           </div>
            <p> © 2023-2024.RausyanulFIkri - Manajemen Dan Pendaftaran Magang</p>
        </div>
        {{-- footer --}}
    </div>

<!--Typed.js -->
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            strings: ['<span class="text-white desktop:text-primary">Kota</span> Langsa'],
            typeSpeed: 50,
            backSpeed: 25,
            backDelay: 1000,
            loop: false
        };

        var typed = new Typed("#typed-output", options);
    });
</script>



{{-- my script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const paragraph = document.getElementById('paragraph');
    const moreAboutButton = document.getElementById('moreAbout');
    const icon = document.getElementById('icon');

    moreAboutButton.addEventListener('click', function () {
        if (paragraph.classList.contains('hidden')) {
            paragraph.classList.remove('hidden');
            icon.setAttribute('icon', 'mingcute:up-fill');
        } else {
            paragraph.classList.add('hidden');
            icon.setAttribute('icon', 'mingcute:down-fill');
        }
    });
});

    </script>
@endsection
    
