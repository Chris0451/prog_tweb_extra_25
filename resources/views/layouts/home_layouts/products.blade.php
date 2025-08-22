<section id="prodotti" class="section">
        <h2>Catalogo Prodotti</h2>
        <div class="card">
            <p>Scopri la gamma di computer, stampanti e accessori. Ogni scheda contiene foto, note d'uso e modalità di installazione.</p>
            
            <!-- SEARCHBAR PER PRODOTTI TRAMITE RICERCA PAROLA NELLA DESCRIZIONE -->
            
            <form id="searchFormProducts" method="GET" action="#prodotti">
                <input id="search_prod" name="search_prod" type="text" value="{{ request('search_prod') }}" placeholder="Parola descrizione prodotto (es. Telefono o Tel*)" required>
                <input id="submit_prod" type="submit" value="Ricerca">
            </form>

            <!-- SEARCHBAR PER MALFUNZIONAMENTI TRAMITE RICERCA PAROLA NELLA DESCRIZIONE -->
            @if(auth()->user()?->role === 'tecnico' || auth()->user()?->role === 'staff')
                <form id="searchFormProducts" method="GET" action="#prodotti">
                    <input id="search_malf" name="search_malf" type="text" value="{{ request('search_malf') }}" placeholder="Parola descrizione malfunzionamento (es. Display)">
                    <input id="submit_malf" type="submit" value="Ricerca">
                </form>

                <div>
                    <form id="selectProducts" method="GET" action="#prodotti" class="mf-form">
                        <!-- SELECT PER PRODOTTO -->
                        <div class="mf-fields">
                            <label for="prod" class="mf-label">Prodotto</label>
                            <select id="prod" name="prod_id" class="mf-select" data-malfs-base="{{ url('/api/products') }}">
                            <option value="">— Nessun prodotto selezionato —</option>
                            @foreach($prodotti_select as $prodotto)
                                <option value="{{ $prodotto->id }}" 
                                    @selected((int)($selected_product_id ?? 0) === $prodotto->id)>
                                {{ $prodotto->nome }}
                                </option>
                            @endforeach
                            </select>

                            <label for="malfunctions" class="mf-label">Malfunzionamento</label>
                            <select id="malfunctions" name="malf_id" class="mf-select" disabled>
                                <option value="">— Seleziona un malfunzionamento —</option>
                            </select>
                        </div>

                        <div class="mf-actions">
                            <input id="submitSelect" type="submit" value="Ricerca" class="mf-btn" disabled>
                        </div>

                        {{-- Bottone separato per tornare a tutti i prodotti --}}
                        <div class="mf-return">
                            <a href="{{ route('home') }}#prodotti" class="mf-btn-return">Ritorna tutti i prodotti</a>
                        </div>
                    </form>
                </div>

            @endif

            <div style="margin-bottom: 20px;">
                {{ $prodotti->links('pagination::default-prodotti') }}
            </div>

            <div class="row" style="display: flex; flex-wrap: wrap; gap: 20px;"> 
                @foreach($prodotti as $prodotto)
                    <div id="paginator">
                        <img src="{{ asset('storage/images/products/'.$prodotto->foto ?? 'images/placeholder.jpg') }}" alt="Immagine prodotto" style="width: 100%; height: auto; border-radius: 8px;">
                        <h3>{{ $prodotto->nome }}</h3>
                        {{-- SI NASCONDONO LE DESCRIZIONI GENERALI DEL PRODOTTO QUANDO SI RICERCA NELLA HOME IL MALFUNZIONAMENTO DI UN PRODOTOT TRAMITE SELECT O TRAMITE SEARCH BAR--}}
                        @if (!(request()->filled('prod_id') && request()->filled('malf_id')) && !(request()->filled('search_malf')))
                            <p><strong>Marca:</strong> {{ $prodotto->marca }}</p>
                            <p><strong>Modello:</strong> {{ $prodotto->modello }}</p>
                            <p><strong>Descrizione:</strong> {{ $prodotto->descrizione }}</p>
                            <p><strong>Tecniche d'uso:</strong> {{ $prodotto->tecniche_uso }}</p>
                            <p><strong>Installazione:</strong> {{ $prodotto->mod_installazione }}</p>
                        @endif
                        @if(auth()->user()?->role === 'tecnico' || auth()->user()?->role === 'staff')
                            <!-- Contenuto per tecnico e staff:
                                 Mostrare i malfunzionamenti e le relative soluzioni di ogni prodotto
                            -->
                            <hr>
                            <h3 style="color: red;">Malfunzionamenti</h3>
                            @forelse($prodotto->malfunzionamento ?? [] as $m)
                            @php
                                $hasText = request()->filled('search_malf');
                                $hasId   = request()->filled('malf_id');
                                $desc    = strtolower($m->descrizione ?? '');
                                $needle  = strtolower(request('search_malf', ''));
                            @endphp

                            @if(
                                // 1) Nessun filtro: mostra tutto
                                (!$hasText && !$hasId)
                                ||
                                // 2) Filtro testuale sui malfunzionamenti
                                ($hasText && str_contains($desc, $needle))
                                ||
                                // 3) Filtro per ID malfunzionamento da select
                                ($hasId && request('malf_id') == $m->id)
                            )
                                <div style="margin-bottom:10px;">
                                    <h4 style="color: #7b0707c1;">{{ $m->tipologia ?? 'Malfunzionamento' }}</h1>

                                    <div>{{ $m->descrizione }}</div>
                                    
                                    @if($m->soluzione_tecnica->isNotEmpty())
                                    <h3 style="color: green;" class="true_malf">Soluzioni</h3>
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
                            @endif
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