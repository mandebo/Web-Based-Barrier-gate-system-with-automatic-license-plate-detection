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



        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <link
            href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
            rel="stylesheet"
        />




    </head>


    <body>


        {{--            <button type="button"> {{ Auth::user()->name }}</button>--}}

            <nav>

                <div class="logo">
                    <i class="bx bx-menu menu-icon"></i>

                    <span class="logo-name">EasyPark</span>
                </div>
                <div class="sidebar">
                    <div class="logo">
                        <i class="bx bx-menu menu-icon"></i>
                        <span class="logo-name">EasyPark</span>
                    </div>

                    <div class="sidebar-content">
                        <ul class="lists">
                            <li class="list">
                                <a href="#" class="nav-link">
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
                                <a href="#" class="nav-link">
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
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
