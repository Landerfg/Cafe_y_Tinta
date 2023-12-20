<?php
// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header("Location: ../public/html/inicio_sesion.html");
    exit();


?>