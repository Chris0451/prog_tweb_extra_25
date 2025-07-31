//MENU HAMBURGER ALLA RIDUZIONE DELLA LARGHEZZA DELLO SCHERMO
function toggleMenu() {
            const navbar = document.getElementById('navbar');
            navbar.classList.toggle('active');
}

// Sticky navbar e Torna su
window.onscroll = function() {
    handleStickyNavbar();
    handleBackToTop();
};

const navbar = document.getElementById("navbar");
const backToTopBtn = document.getElementById("backToTop");
const stickyOffset = navbar.offsetTop;
function handleStickyNavbar() {
    if (window.pageYOffset > stickyOffset) {
        navbar.classList.add("sticky");
    } else {
        navbar.classList.remove("sticky");
    }
}

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