<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <!-- Custom CSS -->
        <link href="css/custom.css" rel="stylesheet">
        <title>&#10084; Mhhhh, Catnip! &#10084;</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <!-- Toastr -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" 
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        
        <!-- Toastr END -->

        <style>
        body {
        overflow-x: hidden;
        }
        #sidebar-wrapper {
        min-height: 100vh;
        margin-left: -15rem;
        -webkit-transition: margin .25s ease-out;
        -moz-transition: margin .25s ease-out;
        -o-transition: margin .25s ease-out;
        transition: margin .25s ease-out;
        }
        #sidebar-wrapper .sidebar-heading {
        padding: 0.875rem 1.25rem;
        font-size: 1.2rem;
        }
        #sidebar-wrapper .list-group {
        width: 15rem;
        }
        #page-content-wrapper {
        min-width: 100vw;
        }
        #wrapper.toggled #sidebar-wrapper {
        margin-left: 0;
        }
        @media (min-width: 768px) {
        #sidebar-wrapper {
            margin-left: 0;
        }
        #page-content-wrapper {
            min-width: 0;
            width: 100%;
        }
        #wrapper.toggled #sidebar-wrapper {
            margin-left: -15rem;
        }
        }
        </style>    
    </head>
    <body>
        <div>
            <!-- Navbar for small devices -->
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm d-lg-none">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            {{-- <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link">
                                    <span class="material-icons">
                                        dashboard
                                    </span>
                                    {{ __('menu.dashboard') }}
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{ route('methods') }}" class="nav-link">
                                    <span class="material-icons">
                                        science
                                    </span>
                                    {{ __('menu.methods') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('specmethods') }}" class="nav-link">
                                    <span class="material-icons">
                                        science
                                    </span>
                                    {{ __('menu.specificmethods') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('categories') }}" class="nav-link">
                                    <span class="material-icons">
                                        pest_control
                                    </span>
                                    {{ __('menu.pestcategories') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pests') }}" class="nav-link">
                                    <span class="material-icons">
                                        pest_control_rodent
                                    </span>
                                    {{ __('menu.pests') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <span class="material-icons">
                                        home_repair_service
                                    </span>
                                    {{ __('menu.equipment') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('formulas') }}" class="nav-link">
                                    <span class="material-icons">
                                        biotech
                                    </span>
                                    {{ __('menu.formulas') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('documents') }}" class="nav-link">
                                    <span class="material-icons">
                                        description
                                    </span>
                                    {{ __('menu.documents') }}
                                </a>
                            </li>
                            @if(Auth::user()->rank == 3)
                            <li class="nav-item">
                                <a href="{{ route('users') }}" class="nav-link">
                                    <span class="material-icons">
                                        people
                                    </span>
                                    {{ __('menu.users') }}
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route('profile') }}" class="nav-link">
                                    <span class="material-icons icon-profile">
                                        person_outline
                                    </span>
                                    {{ __('menu.profile') }}
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <span class="material-icons icon-notifications">
                                        notifications
                                    </span>
                                    {{ __('menu.notifications') }}
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{ route('help') }}" class="nav-link">
                                    <span class="material-icons icon-help">
                                        help
                                    </span>
                                    {{ __('menu.help') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                class="nav-link">
                                    <span class="material-icons icon-logout">
                                        logout
                                    </span>
                                    {{ __('menu.logout') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- /Navbar for small devices -->
        </div>
        <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">
            Dedetizar Admin
        </div>
        <div class="list-group list-group-flush">
            {{-- <a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-light">
                <span class="material-icons">
                    dashboard
                </span>
                {{ __('menu.dashboard') }}</a> --}}
            <a href="{{ route('methods') }}" class="list-group-item list-group-item-action bg-light">
                <span class="material-icons">
                    science
                </span>
                {{ __('menu.methods') }}</a>
            <a href="{{ route('specmethods') }}" class="list-group-item list-group-item-action bg-light">
                <span class="material-icons">
                    science
                </span>
                {{ __('menu.specificmethods') }}</a>
            <a href="{{ route('categories') }}" class="list-group-item list-group-item-action bg-light">
                <span class="material-icons">
                    pest_control
                </span>
                {{ __('menu.pestcategories') }}</a>
            <a href="{{ route('pests') }}" class="list-group-item list-group-item-action bg-light">
                <span class="material-icons">
                    pest_control_rodent
                </span>
                {{ __('menu.pests') }}</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">
                <span class="material-icons">
                    home_repair_service
                </span>
                {{ __('menu.equipment') }}</a>
            <a href="{{ route('formulas') }}" class="list-group-item list-group-item-action bg-light">
                <span class="material-icons">
                    biotech
                </span>
                {{ __('menu.formulas') }}</a>
            <a href="{{ route('documents') }}" class="list-group-item list-group-item-action bg-light">
                <span class="material-icons">
                    description
                </span>
                {{ __('menu.documents') }}</a>
            @if(Auth::user()->rank == 3)
            <a href="{{ route('users') }}" class="list-group-item list-group-item-action bg-light">
                <span class="material-icons">
                    people
                </span>
                {{ __('menu.users') }}</a>
            @endif
            <a href="{{ route('profile') }}" class="list-group-item list-group-item-action bg-light">
                <span class="material-icons icon-profile">
                    person_outline
                </span>
                {{ __('menu.profile') }}</a>
            {{-- <a href="#" class="list-group-item list-group-item-action bg-light">
                <span class="material-icons icon-notifications">
                    notifications
                </span>
                {{ __('menu.notifications') }} <span class="badge badge-danger badge-pill">10</span></a> --}}
            <a href="{{ route('help') }}" class="list-group-item list-group-item-action bg-light">
                <span class="material-icons icon-help">
                    help
                </span>
                {{ __('menu.help') }}</a>
            <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action bg-light">
                <span class="material-icons icon-logout">
                    logout
                </span>
                {{ __('menu.logout') }}</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        </div>
        <!-- /#sidebar-wrapper -->
        
        <!-- Page Content -->
        <div id="page-content-wrapper">
        <main class="py-4">
            @yield('content')
        </main>
        </div>
        <!-- /#page-content-wrapper -->
        </div>
        <!-- /#wrapper -->

        <!-- <script>
            @if(Session::has('success'))
            toastr.options =
            {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "onClick": function(e){ this.hide(); }
            }
                    toastr.success("{{ session('success') }}");
                    
            @endif
          
            @if(Session::has('error'))
            toastr.options =
            {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "onClick": function(e){ this.hide(); }
            }
                    toastr.error("{{ session('error') }}");
            @endif
          
            @if(Session::has('info'))
            toastr.options =
            {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "onClick": function(e){ this.hide(); }
            }
                    toastr.info("{{ session('info') }}");
            @endif
          
            @if(Session::has('warning'))
            toastr.options =
            {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "onClick": function(e){ this.hide(); }
            }
                    toastr.warning("{{ session('warning') }}");
            @endif

            @if($errors->any())
                toastr.options =
                {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-center",
                    "preventDuplicates": true,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "onClick": function(e){ this.hide(); }
                }
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif
        </script> -->
        
        <!-- Bootstrap, JQuery & Popper -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>