@extends('layouts.users_layouts.dashboard')

@section('content')
<div class="insert-user-form">
    <h3>Inserisci una nuova soluzione</h3>

    <div class="container-form">
        <div class="wrap-form">
            {{ html()->form()->method('POST')->route('solution.store')->class(['data-form'])->attribute('enctype', 'multipart/form-data')->open()}}

            <div class="wrap-input rs1-wrap-input">
                {{ html()->label('Malfunzionamento associato', 'id_malfunzionamento')->class(['label-input']) }}
                {{ html()->select('id_malfunzionamento', ['' => '-- Seleziona malfunzionamento --'] + $malfs, old('id_malfunzionamento'))->class(['input'])->id('id_malfunzionamento')->attribute('required', true) }}
                @if ($errors->first('id_malfunzionamento'))
                <ul class="errors">
                    @foreach ($errors->get('id_malfunzionamento') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div  class="wrap-input  rs1-wrap-input">
                {{ html()->label('Tipologia', 'tipologia')->class(['label-input']) }}
                {{ html()->text('tipologia')->class(['input'])->id('tipologia') }}
                @if ($errors->first('tipologia'))
                <ul class="errors">
                    @foreach ($errors->get('tipologia') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div  class="wrap-input  rs1-wrap-input">
                {{ html()->label('Descrizione', 'descrizione')->class(['label-input']) }}
                {{ html()->textarea('descrizione')->class(['input'])->id('descrizione') }}
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