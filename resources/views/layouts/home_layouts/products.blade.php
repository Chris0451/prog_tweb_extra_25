<section id="prodotti" class="section">
        <h2>Catalogo Prodotti</h2>
        <div class="card">
            <p>Scopri la gamma di computer, stampanti e accessori. Ogni scheda contiene foto, note d'uso e modalità di installazione.</p>
            <form id="searchFormProducts" method="GET" action="#prodotti">
                <input id="search" name="search" type="text" value="{{ request('search') }}" placeholder="Ricerca nella descrizione (anche con Tel*)">
                <input id="submit" type="submit" value="Ricerca">
            </form>
            <div class="row" style="display: flex; flex-wrap: wrap; gap: 20px;"> 
                @foreach($prodotti as $prodotto)
                    <div id="paginator">
                        <img src="{{ asset($prodotto->foto ?? 'images/placeholder.jpg') }}" alt="Immagine prodotto" style="width: 100%; height: auto; border-radius: 8px;">
                        <h3>{{ $prodotto->nome }}</h3>
                        <p><strong>Marca:</strong> {{ $prodotto->marca }}</p>
                        <p><strong>Modello:</strong> {{ $prodotto->modello }}</p>
                        <p><strong>Descrizione:</strong> {{ $prodotto->descrizione }}</p>
                        <p><strong>Tecniche d'uso:</strong> {{ $prodotto->tecniche_uso }}</p>
                        <p><strong>Installazione:</strong> {{ $prodotto->mod_installazione }}</p>
                        @if(auth()->user()?->role === 'tecnico')
                            <!-- Contenuto per tecnico:
                                 Mostrare i malfunzionamenti e le relative soluzioni di ogni prodotto
                            -->
                            <hr>
                            <h3 style="color: red;">Malfunzionamenti</h3>
                            @forelse($prodotto->malfunzionamento ?? [] as $m)
                                <div style="margin-bottom:10px;">
                                    <h4 style="color: #7b0707c1;">{{ $m->tipologia ?? 'Malfunzionamento' }}</h1>

                                    <div>{{ $m->descrizione }}</div>
                                    
                                    @if($m->soluzione_tecnica->isNotEmpty())
                                    <h3 style="color: green;">Soluzioni</h3>
                                        <ol>
                                            @foreach($m->soluzione_tecnica ?? [] as $s)
                                                <li>
                                                    <h4 style="color: #2f9c0094">{{$s->tipologia}}</h4>
                                                    <p>{{ $s->descrizione }}</p>
                                                </li>
                                            @endforeach
                                        </ol>
                                    @else
                                        <em>Nessuna soluzione registrata</em>
                                    @endif
                                </div>
                            @empty
                                <em>Nessun malfunzionamento registrato</em>
                            @endforelse
                        @endif
                    </div>
                @endforeach
            </div>
            
            <div style="margin-top: 20px;">
                {{ $prodotti->links('pagination::default-prodotti') }}
            </div>
        </div>
</section>