<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    {{-- cropper.js --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">

    {{-- tailwind css framework --}}
    @vite('resources/css/app.css')

    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:wght@100;400;500;700;800&family=Poppins:ital,wght@0,100;0,400;0,600;0,700;0,800;0,900;1,400&display=swap"
        rel="stylesheet">

    {{-- my css --}}

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- animated css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>

   
        @yield('container')




    @yield('script')

    {{-- my javascript --}}
    <script src="{{asset('js/responsiveNavbar.js')}}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- TypedJs -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    {{-- iconify --}}
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    {{-- javascript dari kalender.io (cdn) --}}
    

</body>

</html>
