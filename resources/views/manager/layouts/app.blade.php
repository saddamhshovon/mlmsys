<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>MLMSYS - @yield('title')</title>

    @yield('meta')

    @include('manager.layouts.partials._favicon')

    @yield('styles')

</head>

<body>

    @yield('content')

    @yield('scripts')

</body>

</html>
