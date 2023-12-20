<?php
// require_once 'Database.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../config/autoload.php');
include ('../db/queries.php');

try {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $token = $_GET["token"] ?? null;

        if ($token !== null) {
            $db = Database::getInstance();
            $row = obtenerTokenPorTokenYFecha($db, $token);

            if ($row) {
                // El token es válido y no ha expirado, mostrar el formulario de restablecimiento de contraseña
                include '../public/html/restablecer_contraseña.html';
            } else {
                echo "El token no es válido o ha expirado.";
            }
        } else {
            echo "Error: No se proporcionó ningún token.";
        }
    } else {
        echo "Error: Esta página solo acepta solicitudes GET.";
    }

    $db->cerrarConexion();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
