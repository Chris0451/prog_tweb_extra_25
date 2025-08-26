@extends('layouts.users_layouts.dashboard')

@section('content')
    @section('scripts')
        @parent
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
        <script src="{{ asset('js/script.js') }}" ></script>

        <script>
        $(function () {
            const pattern     = "{{ route('solution.delete', ':id') }}";
            const $deleteForm = $('#delete-form');

            // Delego il click su tutti i link .delete (anche generati dopo)
            $(document).on('click', 'a.delete', function (e) {
                e.preventDefault();

                const id      = $(this).data('id');
                const $row    = $(this).closest('tr');
                const malfName = $row.closest('table').find('caption.name').text().trim();
                const solName = $row.find('.sol_name').text().trim();

                if (confirm(`Sei sicuro di cancellare la soluzione '${solName}' del malfunzionamento '${malfName}'?`)) {
                    const action = pattern.replace(':id', id);
                    $deleteForm.attr('action', action).trigger('submit');
                }
            });
        });
        </script>
    @endsection

@foreach ($prods as $p)
@php $malfs = $malfPaginated[$p->id] ?? null; @endphp
    @foreach ($p->malfunzionamento as $m)
        <div class="table-items">
            <table>
                <caption class="name" id="{{ $m->id }}">{{ $m->tipologia }} - {{ $p->nome }}</caption>
                <colgroup>
                    <col width="20%">
                    <col width="65%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr>
                        <th>Tipologia soluzione</th>
                        <th>Descrizione</th>
                        <th>Modifica/Cancella</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($m->soluzione_tecnica as $s)
                    <tr>
                        <td class="sol_name">{{$s->tipologia}}</td>
                        <td>{{$s->descrizione}}</td>
                        <td>
                            <a href="{{ route('solution.edit', [$s->id])  }}" style="border-bottom: 0px; color:green">
                                <span class="material-icons">edit</span>&nbsp;
                            </a>
                            <a href="#" class="delete" data-id="{{ $s->id }}" style="border-bottom: 0px; color:red">
                                <span class="material-icons">delete</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="3">Nessuna soluzione per questo malfunzionamento.</td></tr>
                    @endforelse
                    @if ($malfs)
                        <div class="pag-malfs">
                            {{ $malfs->links('pagination::default') }}
                        </div>
                    @endif
                </tbody>
            </table>
        </div>
    @endforeach
@endforeach
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<div class="pag-prods">
    {{ $prods->links('pagination::default') }}
</div>
@endsection