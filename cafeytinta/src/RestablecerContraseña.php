<?php
// require_once 'Database.php';
include ('../config/autoload.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $token = $_GET["token"] ?? null;

    if ($token !== null) {
        $db = new Database();
        $stmt = $db->prepare("SELECT * FROM tokens WHERE token = ? AND fecha_expiracion > NOW()");
        $stmt->execute([$token]);
        $row = $stmt->fetch();

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
?>
