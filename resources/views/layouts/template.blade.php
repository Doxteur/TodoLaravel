<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{-- @stack('scripts') --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"
        integrity="sha256-xH4q8N0pEzrZMaRmd7gQVcTZiFei+HfRTBPJ1OGXC0k=" crossorigin="anonymous"></script>
</head>

<body>
    <?php 
    
session_start();

    $_SESSION['flash_message'] = "I'm a flash message";
    ?>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/">Ma Todo List</a>
        <a class="navbar-brand btn btn-primary" href="liste">Liste</a>

        <a class="navbar-brand btn btn-danger" href="compteur">Compteur</a>
    </nav>

    {{-- Side Bar --}}
    @yield('sidebar')
    {{-- Content --}}
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        @yield('content')
    </main>
    @yield('compteur')
    </div>
</body>

</html>
