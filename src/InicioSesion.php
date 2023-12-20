<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../config/autoload.php');
include('../db/queries.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos
    $conn = Database::getInstance();

    // Procesar datos del formulario de inicio de sesión
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];


    // Obtener el usuario de la base de datos
    $usuario = obtenerUsuarioPorCorreo($conn, $correo);

    $conn->cerrarConexion();

    if ($usuario && password_verify($contrasena, $usuario['contrasenya_usuario'])) {

        session_start();
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];

        header("Location: PaginaPrincipal.php");
        exit();
    } else {
        // AGRGAR ERROR EN HTML
        echo "Credenciales incorrectas. Inténtalo de nuevo.";
    }
}
