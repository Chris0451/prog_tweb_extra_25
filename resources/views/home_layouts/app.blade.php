<!DOCTYPE html>
<html lang="it">
@include('home_layouts.structures.head')
<body>
    @include('home_layouts.structures.header')

    <button class="menu-toggle" onclick="toggleMenu()">☰ Sezioni Home</button>
    @include('home_layouts.structures.navbar')

    @yield('content')

    <!-- Pulsante Torna su -->
    <button id="backToTop" title="Torna su">↑</button>

    @include('home_layouts.structures.footer')

    <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
