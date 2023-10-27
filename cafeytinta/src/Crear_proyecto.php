<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// require_once 'Database.php';
include ('../config/autoload.php');


session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: inicio_sesion.php");
    exit();
}

var_dump($_POST);

$conn = new Database();

//Recuperar todos los usuarios de la base de datos
$sql = "SELECT id_usuario FROM usuarios";
$stmt = $conn->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);


$id_usuario_propietario = $_SESSION['id_usuario'];
$titulo_proyecto = $_POST['titulo_proyecto'];
$descripcion_proyecto = $_POST['descripcion_proyecto'];
$nombre_categoria = $_POST['nombre_categoria'];

$sql = "SELECT id_categoria FROM categorias_genero WHERE nombre_categoria = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$nombre_categoria]);
$id_categoria_genero = $stmt->fetchColumn();


$sql = "INSERT INTO proyectos (id_usuario_propietario,titulo_proyecto, descripcion_proyecto, id_categoria_genero) VALUES (?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$id_usuario_propietario,$titulo_proyecto, $descripcion_proyecto, $id_categoria_genero]);

$id_proyecto = $conn->lastInsertId(); // Obtener el ID del proyecto creado para meterlo en el insert notif

// Inserta una nueva notificación en la tabla 'notif'
$autor = $_SESSION['nombre_usuario'];;
$mensaje = 'Un nuevo proyecto ha sido creado: ' . $titulo_proyecto;
$sql = "INSERT INTO notif (autor, mensaje,id_proyecto) VALUES (?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->execute([$autor,$mensaje,$id_proyecto]);


$id_notificacion = $conn->lastInsertId(); // Obtiene el ID de la notificación que acabas de crear
//var_dump($id_notificacion);

foreach ($usuarios as $usuario) {
    $sql = "INSERT INTO notif_usuarios (id_notificacion, id_usuario, estado) VALUES (?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_notificacion, $usuario['id_usuario']]);
}
// $conn->cerrarConexion();

header("Location: PaginaPrincipal.php");
exit();


?>