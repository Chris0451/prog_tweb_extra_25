@extends('layouts.users_layouts.dashboard')

@section('content')
    @section('scripts')
        @parent
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
        <script src="{{ asset('js/script.js') }}" ></script>

        <script>
        $(function () {
            const pattern = "{{ route('center.delete', ':id') }}";
            const $deleteForm = $('#delete-form');

            // event delegation: funziona anche se la riga viene aggiunta dopo
            $(document).on('click', 'a.delete', function (e) {
                e.preventDefault();

                const id   = $(this).data('id');
                const name = $(this).closest('tr').find('.name').text().trim();

                if (confirm(`Sei sicuro di cancellare ${name}?`)) {
                const action = pattern.replace(':id', id);
                $deleteForm.attr('action', action).trigger('submit');
                }
            });
        });
        </script>

    @endsection
<div class="table-items">
    <table>
        <caption>Lista Centri di assistenza</caption>
        <colgroup>
            <col width="30%">
            <col width="30%">
            <col width="25%">
            <col width="15%">
        </colgroup>
        <thead>
            <tr>
                <th>Nome centro</th>
                <th>Indirizzo</th>
                <th>Fotografia</th>
                <th>Modifica/Cancella</th>
            </tr>
        </thead>
        <tbody>
            @foreach($centri as $centro)
            <tr>
                <td class="name">{{$centro->nome}}</td>
                <td>{{$centro->indirizzo}}</td>
                <td style="text-align:center;"><img src="{{ asset('storage/images/assistance_centers/'.$centro->foto ?? 'images/placeholder.jpg') }}" alt="Immagine centro {{ $centro->id }}" style="width: 30%; height: auto; border-radius: 8px;"></td>
                <td>
                    <a href="{{ route('center.edit', [$centro->id])  }}" style="border-bottom: 0px; color:green">
                        <span class="material-icons">edit</span>&nbsp;
                    </a>
                    <a href="#" class="delete" data-id="{{ $centro->id }}" style="border-bottom: 0px; color:red">
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
    {{ $centri->links('pagination::default') }}
</div>
@endsection