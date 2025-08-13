<!DOCTYPE html>
<html lang="it">
@include('layouts.home_layouts.structures.head')
<body class="{{ request()->is('login') ? 'login-page' : '' }}">

    @include('layouts.home_layouts.structures.header')

    @include('layouts.home_layouts.structures.navbar')

    @yield('content')

    <!-- Pulsante Torna su -->
    <button id="backToTop" title="Torna su">↑</button>

    @include('layouts.home_layouts.structures.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>