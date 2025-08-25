@extends('layouts.users_layouts.dashboard')

@section('content')
    @section('scripts')
        @parent
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
        <script src="{{ asset('js/script.js') }}" ></script>

        <script>
        $(function () {
            const pattern = "{{ route('user.delete', ':id') }}";
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
<h2 style="color: blue; text-align:center;">LISTA UTENTI</h2>
<div class="table-items">
    <table>
        <caption>Lista Tecnici</caption>
        <colgroup>
            <col width="15%">
            <col width="15%">
            <col width="15%">
            <col width="10%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
        </colgroup>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Username</th>
                <th>Data di nascita</th>
                <th>Nome centro associato</th>
                <th>Indirizzo centro</th>
                <th>Modifica/Cancella</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tecnici as $tecnico)
            <tr>
                <td class="name">{{$tecnico->utente->nome}}</td>
                <td>{{$tecnico->utente->cognome}}</td>
                <td>{{$tecnico->utente->username}}</td>
                <td>{{$tecnico->data_nascita}}</td>
                <td>{{$tecnico->centro->nome}}</td>
                <td>{{$tecnico->centro->indirizzo}}</td>
                <td>
                    <a href="{{ route('users.edit', [$tecnico->utente->id, $tecnico->utente->role, $tecnico->id])  }}" style="border-bottom: 0px; color:green">
                        <span class="material-icons">edit</span>&nbsp;
                    </a>
                    <a href="#" class="delete" data-id="{{ $tecnico->utente->id }}" style="border-bottom: 0px; color:red">
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
    {{ $tecnici->links('pagination::default') }}
</div>

<div class="table-items">
    <table>
        <caption>Lista Staff</caption>
        <colgroup>
            <col width="20%">
            <col width="20%">
            <col width="20%">
            <col width="20%">
            <col width="20%">
        </colgroup>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Username</th>
                <th>Prodotti assegnati</th>
                <th>Modifica/Cancella</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staffs as $staff)
            <tr>
                <td class="name">{{$staff->utente->nome}}</td>
                <td>{{$staff->utente->cognome}}</td>
                <td>{{$staff->utente->username}}</td>
                <td>
                    <ul>
                        @foreach ($staff->prodotti as $prodotto)
                            <li>{{$prodotto->nome}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="{{ route('users.edit', [$staff->utente->id, $staff->utente->role, $staff->id])  }}" style="border-bottom: 0px; color:green">
                        <span class="material-icons">edit</span>&nbsp;
                    </a>
                    <a href="#" class="delete" data-id="{{ $staff->utente->id }}" style="border-bottom: 0px; color:red">
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
    {{ $staffs->links('pagination::default') }}
</div>

@endsection