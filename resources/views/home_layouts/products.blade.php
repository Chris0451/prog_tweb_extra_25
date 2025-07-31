<section id="prodotti" class="section">
        <h2>Catalogo Prodotti</h2>
        <div class="card">
            <p>Scopri la gamma di computer, stampanti e accessori. Ogni scheda contiene foto, note d'uso e modalità di installazione.</p>
            <div class="row" style="display: flex; flex-wrap: wrap; gap: 20px;">
                @foreach($prodotti as $prodotto)
                    <div style="flex: 0 0 30%; background: white; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                        <img src="{{ asset($prodotto->immagine ?? 'images/placeholder.jpg') }}" alt="Immagine prodotto" style="width: 100%; height: auto; border-radius: 8px;">
                        <h3>{{ $prodotto->nome }}</h3>
                        <p><strong>Marca:</strong> {{ $prodotto->marca }}</p>
                        <p><strong>Modello:</strong> {{ $prodotto->modello }}</p>
                        <p><strong>Tecniche d'uso:</strong> {{ $prodotto->uso_tecnico }}</p>
                        <p><strong>Installazione:</strong> {{ $prodotto->modo_installazione }}</p>
                    </div>
                @endforeach
            </div>
        </div>
</section>