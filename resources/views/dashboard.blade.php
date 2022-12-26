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


    <script src="https://code.jquery.com/jquery-3.5.1.js"> </script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" >
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>










    {{--    CK editor--}}
    <script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <link
        href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
        rel="stylesheet"
    />




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

<nav class="bg-primary border navigation-home">

    <div class="container-fluid ">
        <div class="row justify-content-end">
            <div class="col-md-10 col-sm-10 col-10">
                <i class="bx bx-menu menu-icon pr-2 font-size d-lg-none d-sm-inline d-md-inline" style="color: white"></i>
                <span class="logo-name font-weight-bold font-size" style="color: white" >EasyPark-Residents</span>

            </div>


            <div class="col-md-2 col-sm-2 col-2">

                <span style="color: white">{{ Auth::user()->name }}</span>

            </div>
        </div>

    </div>


    <div class="sidebar  d-lg-none d-sm-block d-md-block">
        <div class="logo">
            <i class="bx bx-menu menu-icon "></i>
            <span class="logo-name">EasyPark</span>
        </div>

        <div class="sidebar-content">
            <ul class="lists">
                <li class="list">
                    <a href="{{ url('registration') }}" class="nav-link">
                        <i class="bx bx-home-alt icon"></i>
                        <span class="link">Manage License Plates</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#" class="nav-link">
                        <i class="bx bx-bar-chart-alt-2 icon"></i>
                        <span class="link">Access History</span>
                    </a>
                </li>
                <li class="list">
                    <a href="{{ url('feedback') }}" class="nav-link">

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
            </ul>
        </div>
    </div>
    </div>

</nav>

<div class="sidenav bg-white border d-none d-lg-block">
    <div class="sidebar-content">
        <ul class="lists">
            <li class="list">
                <a href="{{ url('registration') }}" class="nav-link">
                    <i class="bx bx-car icon"></i>
                    <span class="link">Manage License Plate</span>
                </a>
            </li>
            <li class="list">
                <a href="{{ url('history') }}" class="nav-link">
                    <i class="bx bx-history icon"></i>
                    <span class="link">Access History</span>
                </a>
            </li>
            <li class="list">
                <a href="{{ url('feedback') }}" class="nav-link">
                    <i class="bx bx-message-dots icon"></i>
                    <span class="link">Feedback</span>
                </a>
            </li>
            <li class="list">
                <a href="{{ url('res_announcement') }}" class="nav-link">
                    <i class="bx bx-bell icon"></i>
                    <span class="link">Announcements</span>
                </a>
            </li>

            <li class="list">

                <a href="{{ url('logouts') }}" class="nav-link">
                    <i class="bx bx-log-out icon"></i>
                    <span class="link">Logout</span>
                </a>


            </li>
        </ul>
    </div>
</div>
</div>





{{-- Manage license plate form--}}

<div>
   @yield('register')
</div>



<div>
    @yield('r-announcement')
</div>

@yield('view_announcement')
@yield('registeredit')
@yield('register-delete')
@yield('history')
@yield('feedback')


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



</html>
