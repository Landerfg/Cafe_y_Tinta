<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// require_once 'Database.php';
include('../config/autoload.php');
include('../db/queries.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"] ?? null;
    $password = $_POST["password"] ?? null;

    if ($token !== null && $password !== null) {
        $db = Database::getInstance();
        $row = obtenerTokenPorTokenYFecha($db, $token);

        //var_dump($row);
        if ($row) {
            // El token es válido y no ha expirado, actualizar la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            actualizarContrasena($db, $hashed_password, $row['id_usuario']);


            // Eliminar el token de la base de datos
            eliminarToken($db, $token);

            $db->cerrarConexion();
            echo "La contraseña ha sido actualizada con éxito.";
            // header("refresh:2;url=../public/html/inicio_sesion.html");

        } else {
            echo "El token no es válido o ha expirado.";
        }
    } else {
        echo "No se ha recibido el token o la contraseña.";
    }
}
