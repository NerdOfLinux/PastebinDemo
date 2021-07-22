<!DOCTYPE html>
<html>
    <head>
        <title>
            @if (View::hasSection('title'))
                @yield('title') |
            @endif
            {{ config('app.name') }}
        </title>

        <!-- CSS -->
        <link rel="stylesheet" href="{{ mix('css/style.css') }}">

        <!-- Don't index -->
        <meta name="robots" content="noindex">

        <!-- Custom -->
        @yield('head')
    </head>
    <body>
        @yield('body')

        <!-- JS -->
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
