// El elemento donde quieres mostrar el nombre de usuario
var elemento = document.getElementById("nombre");

var nombre_usuario = "Bienvenido <?php echo $nombre_usuario; ?>";

// La velocidad a la que se escribe el nombre de usuario (en milisegundos)
var velocidad = 100;
var i=0;
// Una función para escribir el nombre de usuario letra por letra
function escribirNombre() {
    if (i < nombre_usuario.length) {
        elemento.innerHTML += nombre_usuario.charAt(i);
        i++;
        setTimeout(escribirNombre, velocidad);
    }
}

// Llamar a la función para empezar a escribir el nombre de usuario
escribirNombre();
