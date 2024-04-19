<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <link href="{{ asset('bootstrap5.3/css/bootstrap.css') }}" rel="stylesheet">

    <!-- link icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- link css -->
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <link rel="shortcut icon" href="{{ asset('imgages/logo.png') }}" type="image/x-icon">

</head>

<body>
    <div class="container-fluid g-0">
        @if (Request::is('login') || Request::is('register'))
            @yield('user')
        @else
            @include('user.layout.header')
        @endif
        <!-- end header -->

        @yield('main')

        <!-- end main -->
        @if (Request::is('login') || Request::is('register'))
            @yield('user')
        @else
            @include('user.layout.footer')
        @endif

    </div>

    <script src="{{ asset('bootstrap5.3/js/bootstrap.js') }}"></script>

    {{-- link jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
