@extends('layouts.users_layouts.dashboard')

@section('content')
    @section('scripts')
        @parent
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
        <script src="{{ asset('js/script.js') }}" ></script>

        <script>
        $(function () {
            const pattern = "{{ route('product.delete', ':id') }}";
            const $deleteForm = $('#delete-form');

            // event delegation: funziona anche se la riga viene aggiunta dopo
            $(document).on('click', 'a.delete', function (e) {
                e.preventDefault();

                const id   = $(this).data('id');
                const name = $(this).closest('tr').find('.name').text().trim();

                if (confirm(`Sei sicuro di cancellare il prodotto: ${name}?`)) {
                const action = pattern.replace(':id', id);
                $deleteForm.attr('action', action).trigger('submit');
                }
            });
        });
        </script>

    @endsection
<div class="table-items">
    <table>
        <caption>Lista prodotti</caption>
        <colgroup>
            <col width="10%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
            <col width="10%">
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
                <th>Foto</th>
                <th>Modifica/Cancella</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prodotti as $prodotto)
            <tr>
                <td class="name">{{$prodotto->nome}}</td>
                <td>{{$prodotto->descrizione}}</td>
                <td>{{$prodotto->tecniche_uso}}</td>
                <td>{{$prodotto->mod_installazione}}</td>
                <td>{{$prodotto->modello}}</td>
                <td>{{$prodotto->marca}}</td>
                <td style="text-align: center;"><img src="{{ asset('storage/images/products/'.$prodotto->foto) }}" style="width: 70%; height: auto; border-radius: 8px;"></td>
                
                <td>
                    <a href="{{ route('product.edit', [$prodotto->id])  }}" style="border-bottom: 0px; color:green">
                        <span class="material-icons">edit</span>&nbsp;
                    </a>
                    <a href="#" class="delete" data-id="{{ $prodotto->id }}" style="border-bottom: 0px; color:red">
                        <span class="material-icons">delete</span>
                    </a>
                </td>
            </tr>
            @endforeach

            <form id="delete-form" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </tbody>
    </table>
</div>
<div class="pag-prods">
    {{ $prodotti->links('pagination::default') }}
</div>
@endsection