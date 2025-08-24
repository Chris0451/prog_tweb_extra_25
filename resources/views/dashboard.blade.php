@extends('layouts.users_layouts.dashboard')

@section('content')

    <main class="dash-wrapper">

        <section class="card-db grid-3">
            
        @include('layouts.users_layouts.structures.user_data')
            @if($user->role === 'tecnico')
                <div class="block">
                    <h2>Centro di Assistenza</h2>
                    @if($centro)
                        <div class="grid-2">
                            <div>
                                <p><strong>Nome:</strong> {{ $centro->nome }}</p>
                                <p><strong>Indirizzo:</strong> {{ $centro->indirizzo }}</p>
                                <p><strong>ID Centro Assistenza:</strong> {{ $tecnico?->id_centro_assistenza ?? '—' }}</p>
                                <img class="foto-centro {{ $centro->id }}" src="{{ $centro->foto_url }}" alt="Foto centro assistenza">
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
                    <ul>
                        <li><strong><a href="">AGGIUNGI NUOVO MALFUNZIONAMENTO</a></strong></li>
                        <li><strong><a href="">VISUALIZZA, MODIFICA O CANCELLA MALFUNZIONAMENTO</a></strong></li>
                    </ul>
                    <h2>SEZIONE SOLUZIONI</h2>
                    <ul>
                        <li><strong><a href="">CREA NUOVA SOLUZIONE</a></strong></li>
                        <li><strong><a href="">VISUALIZZA, MODIFICA O CANCELLA SOLUZIONE</a></strong></li>
                    </ul>
                <div>
            @endif
                
            @if ($user->role === 'admin')
                <div class="block">
                    <h2>SEZIONE PRODOTTI</h2>
                    <ul>
                        <li><strong><a href="{{ route('product.add') }}">CREA NUOVO PRODOTTO</a></strong></li>
                        <li><strong><a href="{{ route('product.list') }}">VISUALIZZA, MODIFICA O CANCELLA PRODOTTI</a></strong></li>
                    </ul>
                    <h2>SEZIONE UTENTI (TECNICI E STAFF)</h2>
                    <ul>
                        <li><strong><a href="">CREA NUOVO UTENTE (TECNICO O STAFF)</a></strong></li>
                        <li><strong><a href="{{ route('users.list') }}">VISUALIZZA, MODIFICA O CANCELLA UTENTI</a></strong></li>
                    </ul>
                    <h2>SEZIONE CENTRI ASSISTENZA</h2>
                    <ul>
                        <li><strong><a href="{{ route('center.add') }}">CREA NUOVO CENTRO DI ASSISTENZA</a></strong></li>
                        <li><strong><a href="{{ route('center.list') }}">VISUALIZZA, MODIFICA O CANCELLA CENTRI DI ASSISTENZA</a></strong></li>
                    </ul>
                <div>
            @endif
            
        </section>
    </main>

@endsection