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
            @if(Auth::user()->role === 'tecnico')
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit">Logout per tecnico</button>
                </form>
            @endif
        @endauth
</nav>