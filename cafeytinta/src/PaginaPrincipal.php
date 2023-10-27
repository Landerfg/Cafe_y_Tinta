<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// include_once 'Database.php';
include ('../config/autoload.php');
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


$conn = new Database();
$stmt = $conn->prepare("SELECT * FROM proyectos WHERE id_usuario_propietario = ?");
$stmt->execute([$id_usuario]);
$proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);



$stmt = $conn->prepare("SELECT n.* FROM notif n JOIN notif_usuarios nu ON n.id_notificacion = nu.id_notificacion WHERE nu.id_usuario = ? AND nu.estado = 0 ORDER BY n.fecha_creacion DESC LIMIT 3");
$stmt->execute([$id_usuario]);
$notificaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($notificaciones);  



if (isset($_POST['notificaciones'])) {
    $notificacionesMarcadas = $_POST['notificaciones'];

    foreach ($notificacionesMarcadas as $notificacionId) {
        // Actualiza el estado de la notificación en la tabla 'notif_usuarios'
        $stmt = $conn->prepare("UPDATE notif_usuarios SET estado = 1 WHERE id_notificacion = ? AND id_usuario = ?");
        $stmt->execute([$notificacionId, $id_usuario]);
    }

    // Después de marcar como vistas, actualizamos la lista de notificaciones no leídas
    $stmt = $conn->prepare("SELECT n.* FROM notif n JOIN notif_usuarios nu ON n.id_notificacion = nu.id_notificacion WHERE nu.id_usuario = ? AND nu.estado = 0 ORDER BY n.fecha_creacion DESC LIMIT 3");
$stmt->execute([$id_usuario]);
$notificaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

 



include '../public/html/pagina_principal.html';


?>
