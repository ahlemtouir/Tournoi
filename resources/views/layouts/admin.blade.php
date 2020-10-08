<html>
    <head>
        <title>Tournoi - @yield('title')</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        @section('sidebar')
           
        @show

        <div class="container">
            @yield('content')
        </div>
        <script src="{{ asset('js/app.js') }}" ></script>
    </body>
</html>