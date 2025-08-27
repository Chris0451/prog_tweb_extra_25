@extends('layouts.users_layouts.dashboard')

@section('content')
<div class="insert-malf-form">
    <h3>Inserisci un nuovo malfunzionamento</h3>

    <div class="container-form">
        <div class="wrap-form">
            {{ html()->form()->method('POST')->route('malfunction.store')->class(['data-form'])->attribute('enctype', 'multipart/form-data')->open()}}

            <div class="wrap-input rs1-wrap-input">
                {{ html()->label('Prodotto associato', 'id_prodotto')->class(['label-input']) }}
                {{ html()->select('id_prodotto', $prodotti->toArray(), old('role'))->class(['input'])->id('id_prodotto')->attribute('required', true) }}
                @if ($errors->first('role'))
                <ul class="errors">
                    @foreach ($errors->get('role') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div  class="wrap-input  rs1-wrap-input">
                {{ html()->label('Tipologia', 'tipologia')->class(['label-input']) }}
                {{ html()->text('tipologia')->class(['input'])->id('tipologia') }}
                @if ($errors->first('notipologiame'))
                <ul class="errors">
                    @foreach ($errors->get('tipologia') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div  class="wrap-input  rs1-wrap-input">
                {{ html()->label('Descrizione', 'descrizione')->class(['label-input']) }}
                {{ html()->text('descrizione')->class(['input'])->id('descrizione') }}
                @if ($errors->first('descrizione'))
                <ul class="errors">
                    @foreach ($errors->get('descrizione') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div class="container-form-btn">
                {{ html()->submit('Aggiungi malfunzionamento')->class(['form-btn1']) }}
            </div>
        </div>
    </div>
</div>
@endsection