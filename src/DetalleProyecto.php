<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// require_once 'Database.php';
include('../config/autoload.php');
include('../db/queries.php');


session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: InicioSesion.php");
}

$conn = Database::getInstance();

// Obtiene el ID del proyecto de la URL
$id_proyecto = $_GET['id'];

// Selecciona los detalles del proyecto de la base de datos
$proyecto = obtenerProyectoPorId($conn, $id_proyecto);
//var_dump($proyecto['id_categoria_genero']);

// Obtiene el nombre de la categoría a partir del ID
$nombre_categoria = obtenerNombreCategoriaPorId($conn, $proyecto['id_categoria_genero']);

$conn->cerrarConexion();

include '../public/html/CrearProyecto/detalle_proyecto.html';
