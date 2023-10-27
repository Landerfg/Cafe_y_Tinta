<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// require_once 'Database.php';
include ('../config/autoload.php');

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: InicioSesion.php");
}

$conn = new Database();


// Obtiene el ID del proyecto de la URL
$id_proyecto = $_GET['id'];

// Selecciona los detalles del proyecto de la base de datos
$sql = "SELECT * FROM proyectos WHERE id_proyecto = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id_proyecto]);
$proyecto = $stmt->fetch(PDO::FETCH_ASSOC);
//var_dump($proyecto['id_categoria_genero']);

// Obtiene el nombre de la categoría a partir del ID
$sql = "SELECT nombre_categoria FROM categorias_genero WHERE id_categoria = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$proyecto['id_categoria_genero']]);
$nombre_categoria = $stmt->fetch(PDO::FETCH_ASSOC)['nombre_categoria'];




$conn->cerrarConexion();

include '../public/html/CrearProyecto/detalle_proyecto.html';
?>
