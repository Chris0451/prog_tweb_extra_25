<!DOCTYPE html>
<html lang="it">
@include('layouts.users_layouts.structures.head')

<body>
    @include('layouts.users_layouts.structures.header')
    
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
                        <h2><a href="">SEZIONE MALFUNZIONAMENTI</a></h2>
                        <h2><a href="">SEZIONE SOLUZIONI</a></h2>
                    <div>
                @endif
                    
                @if ($user->role === 'admin')
                    <div class="block">
                        <h2><a href="">SEZIONE PRODOTTI</a></h2>
                        <h2><a href="">SEZIONE UTENTI (TECNICI E STAFF)</a></h2>
                        <h2><a href="">SEZIONE CENTRI ASSISTENZA</a></h2>
                    <div>
                @endif
            </section>
    </main>
</body>

</html>
