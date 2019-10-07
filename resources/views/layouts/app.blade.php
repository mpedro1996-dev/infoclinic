<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("_imports")
<body>
<div id="app">
    @include("_navbar-principal")

    <main class="py-4">
        @yield('content')
    </main>
    @include("_scripts")
</div>
</body>
</html>
