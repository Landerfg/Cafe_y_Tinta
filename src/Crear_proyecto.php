<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// require_once 'Database.php';
include('../config/autoload.php');
include('../db/queries.php');


session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: inicio_sesion.php");
    exit();
}

//var_dump($_POST);

$conn = Database::getInstance();

//Recuperar todos los usuarios de la base de datos
$usuarios = obtenerTodosLosUsuarios($conn);

$id_usuario_propietario = $_SESSION['id_usuario'];

// Recuperar los datos del formulario
$titulo_proyecto = $_POST['titulo_proyecto'];
$descripcion_proyecto = $_POST['descripcion_proyecto'];
$nombre_categoria = $_POST['nombre_categoria'];

// Obtener el ID de la categoría del género
$id_categoria_genero = obtenerIdCategoriaPorNombre($conn, $nombre_categoria);

// Inserta un nuevo proyecto en la tabla 'proyectos' y obtiene el ID del proyecto creado
$id_proyecto = crearProyecto($conn, $id_usuario_propietario, $titulo_proyecto, $descripcion_proyecto, $id_categoria_genero);

// Inserta una nueva notificación en la tabla 'notif' y obtiene el ID de la notificación creada
$autor = $_SESSION['nombre_usuario'];;
$mensaje = 'Un nuevo proyecto ha sido creado: ' . $titulo_proyecto;
$id_notificacion = crearNotificacion($conn, $autor, $mensaje, $id_proyecto);


//var_dump($id_notificacion);

// Notificar a todos los usuarios
notificarUsuarios($conn, $id_notificacion, $usuarios);


$conn->cerrarConexion();

header("Location: PaginaPrincipal.php");
exit();
