<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EasyPark') }}</title>


    <!-- Fonts -->


    <!-- Styles -->
    {{--        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('custom_css/stylo.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('custom_css/font-awesome.min.css') }}" >

{{--    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap-icons.css') }}" >--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">--}}


    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/boxicons.min.css') }}" >--}}



    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link
        href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
        rel="stylesheet"
    />




</head>


<body>


{{--            <button type="button"> {{ Auth::user()->name }}</button>--}}

<nav class="bg-light border navigation-home">

    <div class="container-fluid ">
        <div class="row justify-content-end">
            <div class="col-md-10 col-sm-10">
                <i class="bx bx-menu menu-icon pr-2 font-size"></i>
                <span class="logo-name font-weight-bold font-size">EasyPark-Residents</span>

            </div>

            <div class="col-md-2 col-sm-2 col-2">

                <span>{{ Auth::user()->name }}</span>


            </div>
        </div>

    </div>
    <div class="sidebar">
        <div class="logo">
            <i class="bx bx-menu menu-icon "></i>
            <span class="logo-name">EasyPark</span>
        </div>

        <div class="sidebar-content">
            <ul class="lists">
                <li class="list">
                    <a href="{{ url('registration') }}" class="nav-link">
                        <i class="bx bx-home-alt icon"></i>
                        <span class="link">Manage License Plate</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#" class="nav-link">
                        <i class="bx bx-bar-chart-alt-2 icon"></i>
                        <span class="link">Access History</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#" class="nav-link">
                        <i class="bx bx-bell icon"></i>
                        <span class="link">Feedback</span>
                    </a>
                </li>
                <li class="list">
                    <a href="{{ url('res_announcement') }}" class="nav-link">
                        <i class="bx bx-message-rounded icon"></i>
                        <span class="link">Announcements</span>
                    </a>
                </li>

                <li class="list">

                    <a href="{{ url('logouts') }}" class="nav-link">
                        <i class="bx bx-log-out icon"></i>
                        <span class="link">Logout</span>
                    </a>


                </li>
        </div>
    </div>
    </div>
</nav>



{{-- Manage license plate form--}}

<div>
   @yield('register')
</div>



<div>
    @yield('r-announcement')
</div>

@yield('view_announcement')


{{--End of License plate registration--}}

<script>
    const navBar = document.querySelector("nav"),
        menuBtns = document.querySelectorAll(".menu-icon"),
        overlay = document.querySelector(".overlay");

    menuBtns.forEach((menuBtn) => {
        menuBtn.addEventListener("click", () => {
            navBar.classList.toggle("open");
        });
    });

    overlay.addEventListener("click", () => {
        navBar.classList.remove("open");
    });
</script>

<!-- Page Content -->

</div>

@stack('modals')

@livewireScripts
</body>

<section class="">
    <!-- Footer -->
    <footer class="bg-secondary text-white text-center footer">
        <!-- Grid container -->


        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</section>

</html>
