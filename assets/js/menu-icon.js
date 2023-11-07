document.querySelector(".bars-menu").addEventListener("click", animateBars);

var line1_bars = document.querySelector(".line1");
var line2_bars = document.querySelector(".line2");
var line3_bars = document.querySelector(".line3");

var menuActive = false; // Variable para rastrear el estado del menú

function animateBars() {
    // Alternar el estado del menú primero
    menuActive = !menuActive;

    if (menuActive) {
        // Si el menú está activado, aplica las clases activas para la animación
        line1_bars.classList.add("activeline1");
        line2_bars.classList.add("activeline2");
        line3_bars.classList.add("activeline3");
    } else {
        // Si el menú está desactivado, quita las clases activas para la animación
        line1_bars.classList.remove("activeline1");
        line2_bars.classList.remove("activeline2");
        line3_bars.classList.remove("activeline3");
    }
}

