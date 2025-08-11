<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard {{ $user->role }}</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>
    <header class="dash-header">
        <h1>Dashboard {{ $user->role }}</h1>
        <div class="dash-user">
            <span class="chip-role">
                {{ strtoupper($user->role ?? 'utente') }}
            </span>
            <form action="{{ route('home') }}">
                <button type="submit" class="btn-logout">Home</button>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>

        </div>
    </header>
    
    <main class="dash-wrapper">

        
            <section class="card grid-3">
                <div class="avatar">
                    <img src="{{ asset('images/technician_placeholder.jpg') }}" alt="Foto tecnico">
                </div>
                
                <div class="block">
                    <h2>Dati {{$user->role}}</h2>
                    <ul class="list">
                        <li><strong>Username:</strong> {{ $user->username }}</li>
                        <li><strong>Nome:</strong> {{ $user->nome }}</li>
                        <li><strong>Cognome:</strong> {{ $user->cognome }}</li>
                        @if($user->role === 'tecnico')
                            <li><strong>Data di nascita:</strong> {{ $tecnico?->data_nascita ?? '—' }}</li>
                            <li><strong>ID Centro Assistenza:</strong> {{ $tecnico?->id_centro_assistenza ?? '—' }}</li>
                        @endif
                    </ul>
                </div>

            @if($user->role === 'tecnico')
                <div class="block">
                    <h2>Centro di Assistenza</h2>
                    @if($centro)
                        <div class="grid-2">
                        <div>
                            <p><strong>Nome:</strong> {{ $centro->nome }}</p>
                            <p><strong>Indirizzo:</strong> {{ $centro->indirizzo }}</p>
                        </div>
                        <div class="foto-centro">
                            <img src="{{ $centro->foto ? asset($centro->foto) : asset('images/placeholder.jpg') }}" alt="Foto centro assistenza">
                        </div>
                        </div>
                    @else
                        <em>Nessun centro associato.</em>
                    @endif
                </div>
            @endif
            
            </section>
            

        <!-- SEZIONE STAFF (CRUD MALFUNZIONAMENTI E SOLUZIONI ASSOCIATE A PRODOTTI ASSEGNATI) -->

        <!-- SEZIONE ADMIN (CRUD PRODOTTI (SENZA MALFUNZIONAMENTI E SOLUZIONI), UTENTI (TECNICI E STAFF) E CENTRI DI ASSISTENZA) -->        

    </main>
</body>

</html>
