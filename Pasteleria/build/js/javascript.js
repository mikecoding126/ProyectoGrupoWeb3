function toggleBusqueda() {
    var searchBar = document.querySelector('.search-bar');
    searchBar.classList.toggle('hidden'); // Agrega o quita la clase 'hidden'
}
document.addEventListener("DOMContentLoaded", function() {
    // Selecciona el elemento del banner
    var banner = document.querySelector('.banner-img');

    // Agrega un evento de escucha para el movimiento del mouse
    banner.addEventListener('mousemove', function(e) {
        // Calcula la posición del mouse dentro del banner
        var xPos = (e.clientX / banner.offsetWidth) * 100;
        var yPos = (e.clientY / banner.offsetHeight) * 100;

        // Aplica el efecto de paralaje ajustando las propiedades CSS del fondo
        banner.style.backgroundPosition = xPos + '% ' + yPos + '%';
    });
});