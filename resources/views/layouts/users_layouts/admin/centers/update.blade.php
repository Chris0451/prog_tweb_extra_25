@extends('layouts.users_layouts.dashboard')

@section('content')
<div class="insert-center-form">
    <h3>Modifica il centro di assistenza </h3>

    <div class="container-form">
        <div class="wrap-form">
            {{ html()->modelForm($centro, 'PUT', route('center.update', $centro))->class(['data-form'])->attribute('enctype', 'multipart/form-data')->open()}}
                
                {{ html()->hidden('id') }}

                <div  class="wrap-input  rs1-wrap-input">
                    {{ html()->label('Nome centro', 'nome')->class(['label-input']) }}
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
                    {{ html()->label('Indirizzo del centro', 'indirizzo')->class(['label-input']) }}
                    {{ html()->text('indirizzo')->class(['input'])->id('indirizzo') }}
                    @if ($errors->first('indirizzo'))
                    <ul class="errors">
                        @foreach ($errors->get('indirizzo') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <div  class="wrap-input  rs1-wrap-input">
                    {{ html()->label('Immagine','foto')->class(['label-input']) }}
                    {{ html()->input('file','foto')->class(['input'])->id('foto')->attribute('accept', 'image/png,image/jpeg,image/jpg') }}
                    @if ($errors->first('foto'))
                    <ul class="errors">
                        @foreach ($errors->get('foto') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <div class="container-form-btn">
                    {{ html()->submit('Modifica Centro')->class(['form-btn1']) }}
                </div>

            {{ html()->form()->close() }}
        </div>
    </div>
</div>
@endsection