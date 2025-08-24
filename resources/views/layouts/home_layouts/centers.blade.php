<section id="centri" class="section">
        <h2>Centri di Assistenza</h2>
        <div class="card">
            <p>Trova il centro più vicino a te tra i nostri affiliati. Visualizza orari, contatti e specializzazioni.</p>
            <div class="row" style="display: flex; flex-wrap: wrap; gap: 20px;"> 
                @foreach($centri as $centro)
                    <div id="paginator">
                        <img src="{{ $centro->foto_url }}" alt="Immagine centro assistenza {{ $centro->id }}" style="width: 100%; height: auto; border-radius: 8px;">
                        <p><strong>Nome:</strong> {{ $centro->nome }}</p>
                        <p><strong>Indirizzo:</strong> {{ $centro->indirizzo }}</p>
                    </div>
                @endforeach
            </div>
            <div style="margin-top: 20px;">
                {{ $centri->links('pagination::default-centri') }}
            </div>
        </div>
</section>