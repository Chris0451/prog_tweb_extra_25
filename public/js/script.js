//DEFINIZIONE VARIABILI DI RIFERIMENTO
const navbar = document.getElementById("navbar");
const backToTopBtn = document.getElementById("backToTop");
const stickyOffset = navbar.offsetTop;

//MENU HAMBURGER ALLA RIDUZIONE DELLA LARGHEZZA DELLO SCHERMO
function toggleMenu() {
            const navbar = document.getElementById('navbar');
            navbar.classList.toggle('active');
}

//IMPLEMENTAZIONE FUNZIONI DURANTE LO SCORRIMENTO DELLA PAGINA
window.onscroll = function() {
    handleStickyNavbar();
    handleBackToTop();
};


//NAVBAR ANCORATA ALLO SCORRIMENTO DELLA PAGINA
function handleStickyNavbar() {
    if (window.pageYOffset > stickyOffset) {
        navbar.classList.add("sticky");
    } else {
        navbar.classList.remove("sticky");
    }
}

//FUNZIONE PER PULSANTE "TORNA SU" CON EVENT LISTENER
function handleBackToTop() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        backToTopBtn.classList.add("show");
    } else {
        backToTopBtn.classList.remove("show");
    }
}
backToTopBtn.addEventListener("click", function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

//SCRIPT JQUERY PER SELECT PRODOTTI E MALFUNZIONAMENTI
(function() {
    // === Select form ===
    const $prod   = $('#prod');
    const $malf   = $('#malfunctions');
    const $submitSelect = $('#submitSelect');
    const baseApi = $prod.data('malfs-base');

    // === Text form ===
    const $search = $('#search_malf');
    const $submitText = $('#submit_malf');

    const $searchInput = $('#search_prod');
    const $submitBtn   = $('#submit_prod');

    function toggleButton() {
        const hasValidText = $.trim($searchInput.val()).length > 0;
        $submitBtn.prop('disabled', !hasValidText);
    }

    // Disabilita all'avvio se vuoto o solo spazi
    toggleButton();

    // Controlla a ogni modifica dell'input
    $searchInput.on('input', toggleButton);

    // Helper: reset malf
    function resetMalf(message) {
        $malf.prop('disabled', true).empty()
        .append($('<option>', { value: '', text: message || '— Seleziona prima un prodotto —' }));
    }

    // Abilita submit del form SELECT solo se prodotto + malfunzionamento selezionati
    function refreshSubmitSelect() {
        const ok = ($prod.val() && $malf.val());
        $submitSelect.prop('disabled', !ok);
    }

    // Abilita submit del form TESTO solo se c'è testo
    function refreshSubmitText() {
        const ok = ($search.val() && $search.val().trim() !== '');
        $submitText.prop('disabled', !ok);
    }

    // === MUTUA ESCLUSIONE ===
    // Digitando testo → disabilita il form select
    $search.on('input', function() {
        const hasText = $(this).val().trim() !== '';
        if (hasText) {
        $prod.val('').prop('disabled', true);
        resetMalf();
        refreshSubmitSelect();
        } else {
        $prod.prop('disabled', false);
        }
        refreshSubmitText();
    });

    // Cambio prodotto → disabilita il form testo e carica malfunzionamenti
    $prod.on('change', function() {
        const productId = $(this).val();

        // svuota e disabilita text form
        $search.val('').prop('disabled', !!productId);
        refreshSubmitText();

        if (!productId) {
            // deselezione prodotto
            resetMalf();
            refreshSubmitSelect();
            return;
        }

        resetMalf('Caricamento…');
        refreshSubmitSelect(); // durante il load resta disabilitato

        $.getJSON(`${baseApi}/${productId}/malfunctions`)
        .done(function(data) {
            // Prima opzione vuota obbligatoria
            $malf.empty().append($('<option>', { value: '', text: '— Seleziona un malfunzionamento —' }));

            if (Array.isArray(data) && data.length) {
            // NB: usa 'tipologia' per il testo (coerente con il tuo codice)
            data.forEach(function(m) {
                $malf.append($('<option>', { value: m.id, text: m.tipologia }));
            });
            $malf.prop('disabled', false);
            } else {
            resetMalf('Nessun malfunzionamento registrato');
            }
            refreshSubmitSelect();
        })
        .fail(function() {
            resetMalf('Errore nel caricamento');
            refreshSubmitSelect();
        });
    });

    // Cambio malfunzionamento → ricalcola
    $malf.on('change', refreshSubmitSelect);

    // Stato iniziale
    (function init() {
        // Se arrivi con ricerca testuale già valorizzata
        if ($search.val() && $search.val().trim() !== '') {
        $prod.prop('disabled', true).val('');
        resetMalf();
        } else {
        // Se arrivi con prodotto preselezionato (da query string), scatena il change per popolare i malf
        if ($prod.val()) {
            $search.prop('disabled', true).val('');
            $prod.trigger('change');
        } else {
            resetMalf();
        }
        }
        refreshSubmitText();
        refreshSubmitSelect();
    })();
})();


//FUNZIONE PER CANCELLAZIONE PRODOTTO
function delProd(prod) {
    event.preventDefault();
    const idProd = prod.attr('id');
    const nameProd = prod.closest('tr').find('td.name').html();
    const route = $('#delete-form').attr('action') + '/';
    if (confirm("Sei sicuro di cancellare " + nameProd + "?")) {
        $('#delete-form').attr('action', route + idProd).trigger('submit');
    };
};


//JQUERY PER AVVIO FUNZIONE CANCELLAZIONE AL CLICK DEL BOTTONE
$(function () {
    // Al click sull’icona di cancellazione
    $('.delete').on('click', function (event) {
        event.preventDefault();

        const idProd = $(this).data('id'); // id prodotto
        const nameProd = $(this).closest('tr').find('td.name').text(); // nome prodotto

        // Sostituiamo :id con l'id reale
        const action = window.deleteRoutePattern.replace(':id', idProd);

        if (confirm("Sei sicuro di cancellare " + nameProd + "?")) {
            // Imposta action del form nascosto e invialo
            $('#delete-form').attr('action', action).trigger('submit');
        }
    });
});


