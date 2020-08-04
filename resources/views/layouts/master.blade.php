<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- fontawesome css --}}
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

    {{-- bootstrap css --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    {{-- style --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- title --}}
    <title>@yield('title')</title>
</head>
<body>

    {{-- nav --}}
    @include('layouts.nav')

    {{-- cotnent --}}
    @yield('content')


    {{-- jQuery js --}}
    <script src="{{ asset('js/jquery.js') }}"></script>

    {{-- bootstrap js --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    {{-- jQuery validate --}}
    <script src="{{ asset('js/jquery.validate.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

    @yield('jQuery')
</body>
</html>