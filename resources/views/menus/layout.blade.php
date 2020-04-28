<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap core CSS     -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ asset('css/light-bootstrap-dashboard.css?v=1.4.0') }}" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
    

</head>
<body>
    <div id="app">
        
        <div class="wrapper">            
            @if(Auth::check()) 
            @include("menus/menu")
            <div class="main-panel">                                 
                    
                @include("menus/navbar")                
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>

            </div>
            @endif
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
     <!--   Core JS Files   -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    
    <!--  Notifications Plugin    -->
    <script src="{{ asset('js/bootstrap-notify.js') }}"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="{{ asset('js/light-bootstrap-dashboard.js?v=1.4.0') }}"></script>
    <script src="{{ asset('js/sweetalert2.js') }}" defer></script>
    

</body>
</html>
