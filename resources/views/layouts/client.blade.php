<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đầm vintage korean</title>

    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('clients/css/main.css') }}">
    {{-- icon --}}
    <link rel="shortcut icon" href="{{ asset('clients/images/logos/icon-ko.png') }}" />
</head>

<body>
    @include('layouts.inc.clients.navbar')
    <div style = "margin-top: 80px;"></div>
    @yield('content')

    @include('layouts.inc.clients.footer')




    <!-- jquery -->
    <script src="{{ asset('clients/js/jquery-3.6.0.js') }}"></script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('clients/js/script.js') }}"></script>
    @stack('scripts')
</body>

</html>
