@extends('layouts.users_layouts.dashboard')

@section('content')
<div class="insert-product-form">
    <h3>Modifica il contenuto del prodotto selezionato</h3>

    <div class="container-form">
        <div class="wrap-form">
            {{ html()->modelForm($prodotto, 'PUT', route('product.update', $prodotto))->class(['data-form'])->attribute('enctype', 'multipart/form-data')->open()}}
                
                {{ html()->hidden('id') }}
                
                <div  class="wrap-input  rs1-wrap-input">
                    {{ html()->label('Nome Prodotto', 'nome')->class(['label-input']) }}
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
                    {{ html()->label('Descrizione Prodotto', 'descrizione')->class(['label-input']) }}
                    {{ html()->textarea('descrizione')->class(['input'])->id('descrizione') }}
                    @if ($errors->first('descrizione'))
                    <ul class="errors">
                        @foreach ($errors->get('descrizione') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <div  class="wrap-input  rs1-wrap-input">
                    {{ html()->label('Tecniche di utilizzo', 'tecniche_uso')->class(['label-input']) }}
                    {{ html()->textarea('tecniche_uso')->class(['input'])->id('tecniche_uso') }}
                    @if ($errors->first('tecniche_uso'))
                    <ul class="errors">
                        @foreach ($errors->get('tecniche_uso') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <div  class="wrap-input  rs1-wrap-input">
                    {{ html()->label('Modalità di installazione', 'mod_installazione')->class(['label-input']) }}
                    {{ html()->textarea('mod_installazione')->class(['input'])->id('mod_installazione') }}
                    @if ($errors->first('mod_installazione'))
                    <ul class="errors">
                        @foreach ($errors->get('mod_installazione') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <div  class="wrap-input  rs1-wrap-input">
                    {{ html()->label('Modello prodotto', 'modello')->class(['label-input']) }}
                    {{ html()->text('modello')->class(['input'])->id('modello') }}
                    @if ($errors->first('modello'))
                    <ul class="errors">
                        @foreach ($errors->get('modello') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <div  class="wrap-input  rs1-wrap-input">
                    {{ html()->label('Marca del prodotto', 'marca')->class(['label-input']) }}
                    {{ html()->text('marca')->class(['input'])->id('marca') }}
                    @if ($errors->first('marca'))
                    <ul class="errors">
                        @foreach ($errors->get('marca') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <div class="wrap-input rs1-wrap-input file-with-preview">
                    {{ html()->label('Immagine','foto')->class(['label-input']) }}
                    
                    <div class="file-preview-row">
                        {{ html()->input('file','foto')->class(['input'])->id('foto')->attribute('accept', 'image/png,image/jpeg,image/jpg') }}
                        
                        <div class="wrap-input rs2-wrap-input">
                            @include('layouts.users_layouts.admin.helpers.productImg', [
                                'attrs' => 'logofrm',
                                'imgFile' => $prodotto->foto
                            ])
                        </div>
                    </div>

                    @if ($errors->first('foto'))
                        <ul class="errors">
                            @foreach ($errors->get('foto') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="container-form-btn">
                    {{ html()->submit('Modifica Prodotto')->class(['form-btn1']) }}
                </div>


            {{ html()->closeModelForm() }}
        </div>
    </div>
</div>
@endsection