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

//PULSANTE "TORNA SU" CON EVENT LISTENER
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
