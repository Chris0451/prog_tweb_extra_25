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
                <button type="submit" class="btn-dashboard">Home</button>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-dashboard">Logout</button>
            </form>

        </div>
    </header>
    
    <main class="dash-wrapper">

            <section class="card grid-3">
                
                <div class="block">
                    <div class="avatar">
                        <img src="{{ asset('images/user_placeholder.jpg') }}" alt="Foto tecnico">
                    </div>
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
                        <h2>
                            Centro di Assistenza 
                        </h2>
                        @if($centro)
                            <div class="grid-2">
                                <div>
                                    <p><strong>Nome:</strong> {{ $centro->nome }}</p>
                                    <p><strong>Indirizzo:</strong> {{ $centro->indirizzo }}</p>
                                    <img class="foto-centro" src="{{ $centro->foto ? asset($centro->foto) : asset('images/placeholder.jpg') }}" alt="Foto centro assistenza">
                                </div>
                            </div>
                        @else
                            <em>Nessun centro associato.</em>
                        @endif
                    </div>
                @endif
            
                @if ($user->role === 'staff')
                    <div class="block">
                        <h2>SEZIONE MALFUNZIONAMENTI</h2>
                        <ul class="list">
                            <li><strong>INSERISCI MALFUNZIONAMENTO</strong></li>
                            <li><strong>MODIFICA MALFUNZIONAMENTO</strong></li>
                            <li><strong>ELIMINA MALFUNZIONAMENTO</strong></li>
                        </ul>
                        <h2>SEZIONE SOLUZIONI</h2>
                        <ul class="list">
                            <li><strong>INSERISCI SOLUZIONE</strong></li>
                            <li><strong>MODIFICA SOLUZIONE</strong></li>
                            <li><strong>ELIMINA SOLUZIONE</strong></li>
                        </ul>
                    <div>
                @endif
                    
                @if ($user->role === 'admin')
                    <div class="block">
                        <h2>SEZIONE PRODOTTI</h2>
                        <ul class="list">
                            <li><strong>INSERISCI PRODOTTO</strong></li>
                            <li><strong>MODIFICA DATI PRODOTTO</strong></li>
                            <li><strong>ELIMINA PRODOTTO</strong></li>
                        </ul>
                        <h2>SEZIONE TECNICI</h2>
                        <ul class="list">
                            <li><strong>INSERISCI TECNICO</strong></li>
                            <li><strong>MODIFICA DATI TECNICO</strong></li>
                            <li><strong>ELIMINA TECNICO</strong></li>
                        </ul>
                        <h2>SEZIONE STAFF</h2>
                        <ul class="list">
                            <li><strong>INSERISCI MEMBRO STAFF</strong></li>
                            <li><strong>MODIFICA DATI MEMBRO STAFF</strong></li>
                            <li><strong>ELIMINA MEMBRO STAFF</strong></li>
                        </ul>
                        <h2>SEZIONE CENTRI ASSISTENZA</h2>
                        <ul class="list">
                            <li><strong>INSERISCI CENTRO ASSISTENZA</strong></li>
                            <li><strong>MODIFICA DATI CENTRO ASSISTENZA</strong></li>
                            <li><strong>ELIMINA CENTRO ASSISTENZA</strong></li>
                        </ul>
                    <div>
                @endif
            </section>


    </main>
</body>

</html>
