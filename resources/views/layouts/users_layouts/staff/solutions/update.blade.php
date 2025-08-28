@extends('layouts.users_layouts.dashboard')

@section('content')
<div class="insert-user-form">
    <h3>Modifica la soluzione associata</h3>

    <div class="container-form">
        <div class="wrap-form">
            {{ html()->modelForm($soluzione, 'PUT', route('solution.update', $soluzione))->class(['data-form'])->attribute('enctype', 'multipart/form-data')->open()}}

            {{ html()->hidden('id', $soluzione->id) }}

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
                {{ html()->submit('Modifica soluzione')->class(['form-btn1']) }}
            </div>

        </div>
    </div>
</div>
@endsection