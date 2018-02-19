<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
        <script src="{{ asset('/js/jquery-3.2.0.min.js') }}"></script>
        <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
        
        <style>
            table form { margin-bottom: 0; }
            form ul { margin-left: 0; list-style: none; }
            .error { color: red; font-style: italic; }
            body { padding-top: 70px; }
        </style>
    </head>

    <body>
        @include('partials._navigation') 

        <div class="container">
            @if (Session::has('message'))
                <div class="flash alert">
                    <p>{{ Session::get('message') }}</p>
                </div>
            @endif

            @yield('main')
        </div>

    </body>

</html>