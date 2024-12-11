// Esegui la funzione quando la pagina viene caricata
document.addEventListener('DOMContentLoaded', checkScreenSize);

// Aggiungi un listener per il cambiamento della dimensione dello schermo
window.addEventListener('resize', checkScreenSize);

// Funzione che controlla la dimensione dello schermo e lo stato della checkbox
function checkScreenSize() {
    var checkbox = document.getElementById('menu-btn');
    var carousel = document.getElementById("carouselExampleIndicators");
    var menu = document.querySelector('.menu');

    // Verifica se lo schermo è più largo di 1064
    if (window.innerWidth > 1064) {
        checkbox.checked = false; // Deseleziona la checkbox
        menu.style.maxHeight = "none"; // Mostra il menu per schermi larghi
         // Riposiziona il carosello
    } else {
        menu.style.maxHeight = checkbox.checked ? "400px" : "0"; // Mantieni il comportamento del menu
        /*carousel.style.top = checkbox.checked ? "0px" : "0"; // Regola la posizione del carosello*/
    }
}

// Funzione chiamata al clic sull'icona del menu
function change() {
    var checkbox = document.getElementById("menu-btn");
    var carousel = document.getElementById("carouselExampleIndicators");
    var menu = document.querySelector('.menu');

    carouselNext=document.getElementsByClassName("carousel-control-next")[0];
    carouselPrevious=document.getElementsByClassName("carousel-control-prev")[0];

    carouselIndicator=document.getElementsByClassName("carousel-indicators")[0];


    if (checkbox.checked) {
        console.log('Menu chiuso');
        if (window.innerWidth <= 1064) {
            menu.style.maxHeight = "0"; // Nascondi il menu



           /* carousel.style.top = "0"; 

           /* carouselNext.style.display="block";
            carouselPrevious.style.display="block";
            carouselIndicator.style.display="flex";*/
        }
       
    } else {
        console.log('Menu aperto');
        if (window.innerWidth <= 1064) {
            menu.style.maxHeight = "500px"; // Mostra il menu
            
           
            /*carouselNext.style.display="none";
            carouselPrevious.style.display="none";
            carouselIndicator.style.display="none";*/
            /*carousel.style.top = "150px";*/ // Aggiusta la posizione del carosello per schermi piccoli*/
        }
    }
}


    // Gestire lo zoom dinamico in base alla posizione del cursore
    /*const zoomImages = document.querySelectorAll('.box3 img');

    zoomImages.forEach(img => {
        img.addEventListener('mousemove', function(e) {
            const imgWidth = img.offsetWidth;
            const imgHeight = img.offsetHeight;

            const offsetX = e.offsetX;
            const offsetY = e.offsetY;

            const xPercent = (offsetX / imgWidth) * 100;
            const yPercent = (offsetY / imgHeight) * 100;

            img.style.transformOrigin = `${xPercent}% ${yPercent}%`;
        });

        img.addEventListener('mouseleave', function() {
            img.style.transformOrigin = 'center';
        });
    });
*/


    // Selezioniamo il pulsante del dropdown e il menu
const dropdownToggle = document.getElementById("navbarDropdown");
const dropdownMenu = document.querySelector(".dropdown-menu");

// Funzione per chiudere il menu del dropdown
function closeDropdown() {
    if (dropdownMenu.classList.contains("show")) { // Verifica se il menu è aperto
        dropdownToggle.click(); // Trigger per chiudere il dropdown
    }
}

// Evento di ridimensionamento della finestra
window.addEventListener("resize", closeDropdown);






        
AOS.init({
    offset: 150, // Distanza dall'alto della viewport prima dell'attivazione
    duration: 800, // Durata dell'animazione
    easing: 'ease-in-out',
    once: true, // L'animazione avviene solo una volta
});
