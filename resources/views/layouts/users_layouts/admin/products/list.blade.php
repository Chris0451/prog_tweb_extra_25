@extends('layouts.users_layouts.dashboard')

@section('content')
<div class="table-prods">
    <table>
        <caption>Lista prodotti</caption>
        <colgroup>
            <col width="10%">
            <col width="25%">
            <col width="15%">
            <col width="15%">
            <col width="10%">
            <col width="10%">
            <col width="15%">
        </colgroup>
        <thead>
            <tr>
                <th>Nome prodotto</th>
                <th>Descrizione</th>
                <th>Tecniche d'uso</th>
                <th>Modalità d'installazione</th>
                <th>Modello</th>
                <th>Marca</th>
                <th>Modifica/Cancella</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prodotti as $prodotto)
            <tr>
                <td>{{$prodotto->nome}}</td>
                <td>{{$prodotto->descrizione}}</td>
                <td>{{$prodotto->tecniche_uso}}</td>
                <td>{{$prodotto->mod_installazione}}</td>
                <td>{{$prodotto->modello}}</td>
                <td>{{$prodotto->marca}}</td>
                <td>
                    <a href="{{ route('product.edit', [$prodotto->id])  }}" style="border-bottom: 0px; color:green">
                        <span class="material-icons">edit</span>&nbsp;
                    </a>
                    <a href="" class="delete" id="{{ $prodotto->id }}" style="border-bottom: 0px; color:red">
                        <span class="material-icons">delete</span>
                    </a>
                </td>
            </tr>
            @endforeach
            <form id="delete-form" action="{{-- route('deleteproduct', ['']) --}}" method="POST" style="display: none;">
                {{ csrf_field() }}
                @method('DELETE')
            </form>
        </tbody>
    </table>
</div>
<div class="pag-prods">
    {{ $prodotti->links('pagination::default') }}
</div>
@endsection