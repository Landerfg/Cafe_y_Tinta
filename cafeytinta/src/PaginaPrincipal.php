<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// include_once 'Database.php';
include('../config/autoload.php');
include('../db/queries.php');
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: InicioSesion.php");
    exit();
}

// Obtener detalles del usuario desde la sesión
$id_usuario = $_SESSION['id_usuario'];
$nombre_usuario = $_SESSION['nombre_usuario'];

$conn = Database::getInstance();
// Obtener proyectos del usuario
$proyectos = obtenerProyectosUsuario($conn, $id_usuario);


// Obtener notificaciones no leídas del usuario
$notificaciones = obtenerNotificacionesUsuario($conn, $id_usuario);
//var_dump($notificaciones);  

if (isset($_POST['notificaciones'])) {
    $notificacionesMarcadas = $_POST['notificaciones'];

    foreach ($notificacionesMarcadas as $notificacionId) {
        // Actualiza el estado de la notificación en la tabla 'notif_usuarios'
        marcarNotificacionComoVista($conn, $notificacionId, $id_usuario);
    }
    // Después de marcar como vistas, actualizamos la lista de notificaciones no leídas
    $notificaciones = obtenerNotificacionesUsuario($conn, $id_usuario);
}

$conn->cerrarConexion();

include '../public/html/pagina_principal.html';
