<header class="dash-header">
        <h1>Dashboard {{ $user->role }}</h1>
        <div class="dash-user">
            <span class="chip-role">
                {{ strtoupper($user->role ?? 'utente') }}
            </span>
            <form action="{{ route('home') }}">
                <button type="submit" class="btn-dashboard">Home</button>
            </form>
            <form action="{{ route('dashboard.'.$user->role) }}">
                <button type="submit" class="btn-dashboard">Dashboard</button>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-dashboard">Logout</button>
            </form>
        </div>
</header>