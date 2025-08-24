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
        @endif
    </ul>
</div>