@extends('layouts.users_layouts.dashboard')

@section('content')
<div class="insert-user-form">
    <h3>Modifica il malfunzionamento selezionato</h3>

    <div class="container-form">
        <div class="wrap-form">
            {{ html()->modelForm($malfunzionamento, 'PUT', route('malfunction.update', $malfunzionamento))->class(['data-form'])->attribute('enctype', 'multipart/form-data')->open()}}
            @csrf
            {{ html()->hidden('id', $malfunzionamento->id) }}

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
                {{ html()->submit('Modifica malfunzionamento')->class(['form-btn1']) }}
            </div>

            {{ html()->closeModelForm() }}
        </div>
    </div>
</div>
@endsection