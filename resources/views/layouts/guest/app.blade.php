<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Ionicons -->
    @include('layouts.guest.head')
    <livewire:styles />
</head>

<body id="top">
    @include('layouts.guest.navbar')

    @yield('content')

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    @include('layouts.guest.footer')
    @include('layouts.guest.script-footer')
    <livewire:scripts />

</body>


</html>
