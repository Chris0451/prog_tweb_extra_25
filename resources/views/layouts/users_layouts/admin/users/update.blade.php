@extends('layouts.users_layouts.dashboard')

@section('content')
<div class="insert-user-form">
    <h3>Modifica i dati dell'utente {{ $utente_selezionato->role }}</h3>

    <div class="container-form">
        <div class="wrap-form">
            {{ html()->modelForm($utente_selezionato, 'PUT', route('users.update', ['role' => $role]))->class(['data-form'])->attribute('enctype', 'multipart/form-data')->open()}}
                
                {{ html()->hidden('id', $utente_selezionato->id) }}

                {{ html()->hidden('role', $utente_selezionato->role) }}

                <div  class="wrap-input  rs1-wrap-input">
                    {{ html()->label('Nome utente', 'nome')->class(['label-input']) }}
                    {{ html()->text('nome')->class(['input'])->id('nome') }}
                    @if ($errors->first('nome'))
                    <ul class="errors">
                        @foreach ($errors->get('nome') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <div  class="wrap-input  rs1-wrap-input">
                    {{ html()->label('Cognome utente', 'cognome')->class(['label-input']) }}
                    {{ html()->text('cognome')->class(['input'])->id('cognome') }}
                    @if ($errors->first('cognome'))
                    <ul class="errors">
                        @foreach ($errors->get('cognome') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <div  class="wrap-input  rs1-wrap-input">
                    {{ html()->label('Username', 'username')->class(['label-input']) }}
                    {{ html()->text('username')->class(['input'])->id('username') }}
                    @if ($errors->first('username'))
                    <ul class="errors">
                        @foreach ($errors->get('username') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <div  class="wrap-input  rs1-wrap-input">
                    {{ html()->label('Nuova password', 'password')->class(['label-input']) }}
                    {{ html()->password('password')->class(['input'])->id('password') }}
                    <small>Lascia vuoto se non vuoi cambiare password</small>
                    @if ($errors->first('password'))
                    <ul class="errors">
                        @foreach ($errors->get('password') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <div class="wrap-input rs1-wrap-input">
                    {{ html()->label('Conferma Password', 'password_confirmation')->class(['label-input']) }}
                    {{ html()->password('password_confirmation')->class(['input'])->id('password_confirmation') }}

                    @if ($errors->first('password_confirmation'))
                    <ul class="errors">
                        @foreach ($errors->get('password_confirmation') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                @if ($utente_selezionato->role === 'tecnico')
                    <div class="wrap-input rs1-wrap-input">
                        {{ html()->label('Data di nascita', 'data_nascita')->class(['label-input']) }}
                        {{ html()->date('data_nascita', $utente_selezionato->tecnico->data_nascita)->class(['input'])->id('data_nascita') }}

                        @if ($errors->first('data_nascita'))
                        <ul class="errors">
                            @foreach ($errors->get('data_nascita') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </div>

                    <div  class="wrap-input  rs1-wrap-input">
                        {{ html()->label('Specializzazione', 'specializzazione')->class(['label-input']) }}
                        {{ html()->text('specializzazione', $utente_selezionato->tecnico->specializzazione)->class(['input'])->id('specializzazione') }}
                        @if ($errors->first('specializzazione'))
                        <ul class="errors">
                            @foreach ($errors->get('specializzazione') as $message)
                            <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </div>

                    <div class="wrap-input rs1-wrap-input">
                        {{ html()->label('Nome del centro assistenza associato', 'id_centro_assistenza')->class(['label-input']) }}
                        {{ html()->select('id_centro_assistenza', $centri,  old('id_centro_assistenza', (int) $utente_selezionato->tecnico->id_centro_assistenza))->class(['input'])->id('id_nome_centro_assistenza') }}
                        
                        @if ($errors->first('id_centro_assistenza'))
                        <ul class="errors">
                            @foreach ($errors->get('id_centro_assistenza') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                        @endif
                    
                    </div>
                @endif

                

                @if ($utente_selezionato->role === 'staff')
                    @php
                        $checkedIds = old('prodotti', $prodotti_assegnati); //SELEZIONI MANTENTUTE DOPO ERRORE VALIDAZIONE
                        $inputId = 'prod_' . $prodotto->id;
                    @endphp
                    <div class="wrap-input rs1-wrap-input">
                        {{ html()->label('Nome dei prodotti associati', 'id_nome_prodotto')->class(['label-input']) }}
                        @foreach ($prodotti as $prodotto)
                            {{ html()->label() }}
                            {{ html()->checkbox('prodotti[]', $prodotto->id, in_array($prodotto->id, $checkedIds))->class(['input'])->id('id_nome_prodotto') }}
                            {{ html()->span($prodotto->nome)->class(['product-name'])->id('id_nome_prodotto') }}
                        @endforeach

                        @error('prodotti')
                            <ul class="errors"><li>{{ $message }}</li></ul>
                        @enderror
                        @error('prodotti.*')
                            <ul class="errors"><li>{{ $message }}</li></ul>
                        @enderror
                    </div>

                @endif

                <div class="container-form-btn">
                    {{ html()->submit('Modifica utente')->class(['form-btn1']) }}
                </div>

            {{ html()->closeModelForm() }}
        </div>
    </div>
</div>
@endsection