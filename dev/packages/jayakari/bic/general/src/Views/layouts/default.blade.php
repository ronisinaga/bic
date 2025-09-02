<!doctype html>
<html>
<head>
    @include('jayakari.bic.general::includes.head')
</head>
<body class="corporate">
    @include('jayakari.bic.general::includes.header')

    <div id="main" class="row">

        @yield('content')

    </div>

    <footer class="row">
        @include('jayakari.bic.general::includes.footer')
    </footer>

</body>
</html>