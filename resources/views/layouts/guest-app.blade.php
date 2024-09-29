<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @stack('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/barfiller.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">

<body>
@include('layouts.header-guest')

@yield('content')

@include('layouts.footer-guest')

@stack('scripts')

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/jquery.barfiller.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('success') }}',
    });
    @endif

    @if(session('error'))
    Swal.fire({
        icon: 'info',
        title: 'Login',
        text: '{{ session('error') }}',
    });
    @endif
</script>
</body>

</html>
