@extends('layouts.users_layouts.dashboard')

@section('content')
<div class="insert-user-form">
    <h3>Inserisci un nuovo utente</h3>

    <div class="container-form">
        <div class="wrap-form">
            {{ html()->form()->method('POST')->route('user.store')->class(['data-form'])->attribute('enctype', 'multipart/form-data')->open()}}

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

                <div class="wrap-input rs1-wrap-input">
                    {{ html()->label('Ruolo utente', 'role')->class(['label-input']) }}
                    {{ html()->select('role', ['' => '-Seleziona il ruolo-','tecnico' => 'tecnico', 'staff' => 'staff'], old('role'))->class(['input'])->id('role')->attribute('required', true) }}

                    @if ($errors->first('role'))
                    <ul class="errors">
                        @foreach ($errors->get('role') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                {{-- FORM PER RUOLO TECNICO --}}

                <div class="wrap-input rs1-wrap-input">
                    {{ html()->label('Data di nascita', 'data_nascita')->class(['label-input']) }}
                    {{ html()->date('data_nascita')->class(['input'])->id('data_nascita') }}
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
                    {{ html()->text('specializzazione')->class(['input'])->id('specializzazione') }}
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
                    {{ html()->select('id_centro_assistenza', $centri,  old('id_centro_assistenza', (int) $utente_selezionato->tecnico->id_centro_assistenza))->class(['input'])->id('id_centro_assistenza') }}
                    
                    @if ($errors->first('id_centro_assistenza'))
                    <ul class="errors">
                        @foreach ($errors->get('id_centro_assistenza') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                
                </div>

                {{-- FORM PER RUOLO STAFF --}}
            
                <div class="wrap-input rs1-wrap-input">
                    {{ html()->label('Nome dei prodotti associati', 'id_prodotto')->class(['label-input']) }}
                    @foreach ($prodotti as $prodotto)
                    @php $inputId = 'prod_' . $prodotto->id; @endphp
                        {{ html()->label(
                            html()->checkbox('prodotti[]', in_array($prodotto->id, $checkedIds), $prodotto->id)->class(['product-checkbox'])->id('id_prodotto') 
                            .
                            html()->span($prodotto->nome)->class(['product-name'])->id('id_nome_prodotto')
                        )->for($inputId)->class('product-option') }}
                    @endforeach
                    @error('prodotti')
                        <ul class="errors"><li>{{ $message }}</li></ul>
                    @enderror
                    @error('prodotti.*')
                        <ul class="errors"><li>{{ $message }}</li></ul>
                    @enderror
                </div>

                <div class="container-form-btn">
                    {{ html()->submit('Modifica utente')->class(['form-btn1']) }}
                </div>

            {{ html()->closeModelForm() }}
        </div>
    </div>
</div>
@endsection