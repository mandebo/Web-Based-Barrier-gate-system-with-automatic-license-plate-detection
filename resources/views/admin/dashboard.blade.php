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
{{--    <script src='https://code.jquery.com/jquery-1.12.3.js'></script>--}}
{{--    <script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>--}}
{{--    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" charset="utf-8"></script>--}}

   <script src="https://code.jquery.com/jquery-3.5.1.js"> </script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"> </script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

{{--    Date time picker cdn --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <link
        href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
        rel="stylesheet"
    />

{{--    doughnut chart--}}
    <script src="https://d3js.org/d3.v4.min.js"></script>
    <script src=
                "https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.js"></script>
    <link
        rel="stylesheet"
        href=
            "https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.css"
    />



    <script src=
                "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1/Chart.min.js">
    </script>


{{--    end of doughnut chart--}}



</head>


<body>


{{--            <button type="button"> {{ Auth::user()->name }}</button>--}}

<nav>

    <div class="container-fluid ">
        <div class="row justify-content-end">
            <div class="col-md-10 col-sm-10 col-10">
                <i class="bx bx-menu menu-icon pr-2 font-size"></i>
                <span class="logo-name font-weight-bold font-size">EasyPark-Admins</span>

            </div>

            <div class="col-md-2 col-sm-2 col-2">

                <span>{{ Auth::user()->name }}</span>

            </div>
        </div>

    </div>
    <div class="sidebar">
        <div class="logo">
            <i class="bx bx-menu menu-icon"></i>
            <span class="logo-name">EasyPark</span>
        </div>

        <div class="sidebar-content">
            <ul class="lists">
                <li class="list">
                    <a href="{{ url('monitor') }}" class="nav-link">
                        <i class="bx bx-home-alt icon"></i>
                        <span class="link">Monitor vehicle traffic</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#" class="nav-link">
                        <i class="bx bx-bar-chart-alt-2 icon"></i>
                        <span class="link">Manage announcement</span>
                    </a>
                </li>
                <li class="list">
                    <a href="#" class="nav-link">
                        <i class="bx bx-bell icon"></i>
                        <span class="link">Alert and blacklist</span>
                    </a>
                </li>
                <li class="list">
                    <a href="{{ url('report') }}" class="nav-link">
                        <i class="bx bx-message-rounded icon"></i>
                        <span class="link">Generate access report</span>
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

<section class="overlay"></section>

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

<div id="">

    @yield('monitor')
</div>

<div class="">
    @yield('report')
</div>

<script>
    $(document).ready(function () {
        $('#data-table2').DataTable();
    });
</script>


<script type="text/javascript">

    var delay = 1000;

    var refreshId = setInterval(function () {
        $('#data-table').load(' #data-table');
    }, delay);

</script>




</head>



</body>
</html>
