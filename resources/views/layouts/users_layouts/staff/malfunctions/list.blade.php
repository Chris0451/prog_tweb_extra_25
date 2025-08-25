@extends('layouts.users_layouts.dashboard')

@section('content')
    @section('scripts')
        @parent
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
        <script src="{{ asset('js/script.js') }}" ></script>

        <script>
        $(function () {
            const pattern = "{{ route('malfunction.delete', ':id') }}";
            const $deleteForm = $('#delete-form');

            // event delegation: funziona anche se la riga viene aggiunta dopo
            $(document).on('click', 'a.delete', function (e) {
                e.preventDefault();

                const id   = $(this).data('id');
                const name = $(this).closest('tr').find('.name').text().trim();
                const malf_name = $(this).find('.malf_name').text().trim()

                if (confirm(`Sei sicuro di cancellare il malfunzionamento '${malf_name}' di '${name}'?`)) {
                const action = pattern.replace(':id', id);
                $deleteForm.attr('action', action).trigger('submit');
                }
            });
        });
        </script>
    @endsection

@foreach ($prods as $p)
    <div class="table-items">
        <table>
            <caption class="name">{{ $p->nome }}</caption>
            <colgroup>
                <col width="20%">
                <col width="65%">
                <col width="15%">
            </colgroup>
            <thead>
                <tr>
                    <th>Tipologia malfunzionamento</th>
                    <th>Descrizione</th>
                    <th>Modifica/Cancella</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($malf_prods as $m)
                <tr>
                    <td class="malf_name">{{$m->tipologia}}</td>
                    <td>{{$m->descrizione}}</td>
                    <td>
                        <a href="{{ route('product.edit', [$m->id])  }}" style="border-bottom: 0px; color:green">
                            <span class="material-icons">edit</span>&nbsp;
                        </a>
                        <a href="#" class="delete" data-id="{{ $m->id }}" style="border-bottom: 0px; color:red">
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
        {{ $malf_prods->links('pagination::default') }}
    </div>
@endforeach

@endsection