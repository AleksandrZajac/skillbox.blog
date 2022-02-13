<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog Template for Bootstrap</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
        @if(auth()->id())
        var userId = {{ auth()->id() }};
        @else
        var userId = null;
        @endif
    </script>
</head>

<body>

    <div id="app">

        @include('layouts.nav')
        @include('layouts.websocket')

        <main role="main" class="container">
            <div class="row">
            @yield('content')

            @section('sidebar')

            @include('layouts.sidebar')

            @show()

            </div>

        </main>
        @include('layouts.footer')
    </div>

    <script type="application/javascript" src="{{ asset('js/app.js') }}"></script>
</body>

</html>
