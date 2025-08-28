@extends('layouts.users_layouts.dashboard')

@section('content')
    @section('scripts')
        @parent
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
        <script src="{{ asset('js/script.js') }}" ></script>

        <script>
        $(function () {
            const pattern     = "{{ route('malfunction.delete', ':id') }}";
            const $deleteForm = $('#delete-form');

            // Delego il click su tutti i link .delete (anche generati dopo)
            $(document).on('click', 'a.delete', function (e) {
                e.preventDefault();

                const id      = $(this).data('id');
                const $row    = $(this).closest('tr');
                const prodName = $row.closest('table').find('caption.name').text().trim();
                const malfName = $row.find('.malf_name').text().trim();

                if (confirm(`Sei sicuro di cancellare il malfunzionamento '${malfName}' del prodotto '${prodName}'?`)) {
                    const action = pattern.replace(':id', id);
                    $deleteForm.attr('action', action).trigger('submit');
                }
            });
        });        
        </script>
    @endsection

@foreach ($prods as $p)
    @php
        /** @var \Illuminate\Pagination\LengthAwarePaginator $malfs */
        $malfs = $malfPaginators[$p->id] ?? null;
    @endphp
    <div class="table-items" id="prod_{{ $p->id }}">
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
                @forelse ($malfs as $m)
                <tr>
                    <td class="malf_name">{{$m->tipologia}}</td>
                    <td>{{$m->descrizione}}</td>
                    <td>
                        <a href="{{ route('malfunction.edit', [$m->id])  }}" style="border-bottom: 0px; color:green">
                            <span class="material-icons">edit</span>&nbsp;
                        </a>
                        <a href="#" class="delete" data-id="{{ $m->id }}" style="border-bottom: 0px; color:red">
                            <span class="material-icons">delete</span>
                        </a>
                    </td>
                </tr>
                @empty
                    <tr><td colspan="4">Nessun malfunzionamento per questo prodotto.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="pag-prods">
            {{ $malfs->appends(request()->except("malf_page_{$p->id}"))
                ->fragment("prod_{$p->id}")
                ->links('pagination::default') }}
        </div>
    </div>
    
@endforeach
<div class="pag-prods">
    {{ $prods->appends(request()->except('prod_page'))->links('pagination::default') }}
</div>

<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection