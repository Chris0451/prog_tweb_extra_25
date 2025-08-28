<button class="menu-toggle" onclick="toggleMenu()">☰ Sezioni Home</button>
    <nav id="navbar">
        <a href="#info">Info utili</a>
        <a href="#prodotti">Prodotti</a>
        <a href="#centri">Centri</a>
        <a href="#contatti">Contatti</a>
        @guest
            <a href="{{ route('login') }}">Login - Area riservata</a>
        @endguest

        @auth
            @php($ruolo = Auth::user()->role ?? Auth::user()->ruolo)
            @if($ruolo === 'tecnico')
                <a href="{{ route('dashboard.tecnico') }}">Dashboard Tecnico</a>
            @elseif($ruolo === 'staff')
                <a href="{{ route('dashboard.staff') }}">Dashboard Staff</a>
            @elseif($ruolo === 'admin')
                <a href="{{ route('dashboard.admin') }}">Dashboard Admin</a>
            @endif
        @endauth
    </nav>