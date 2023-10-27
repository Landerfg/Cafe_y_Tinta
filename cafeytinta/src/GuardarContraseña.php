<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// require_once 'Database.php';
include ('../config/autoload.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"] ?? null;
    $password = $_POST["password"] ?? null;

    if ($token !== null && $password !== null) {
        $db = new Database();
        $stmt = $db->prepare("SELECT * FROM tokens WHERE token = ? AND fecha_expiracion > NOW()");
        $stmt->execute([$token]);
        $row = $stmt->fetch();
        //var_dump($row);
        if ($row) {
            // El token es válido y no ha expirado, actualizar la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare("UPDATE usuarios SET contrasenya_usuario = ? WHERE id_usuario = ?");
            $stmt->execute([$hashed_password, $row['id_usuario']]);

        
            // Eliminar el token
            $stmt = $db->prepare("DELETE FROM tokens WHERE token = ?");
            $stmt->execute([$token]);

            echo "La contraseña ha sido actualizada con éxito.";
            // header("refresh:2;url=../public/html/inicio_sesion.html");
            
        } else {
            echo "El token no es válido o ha expirado.";
        }
    } else {
        echo "Error: Los campos 'token' y 'password' son necesarios.";
    }
}
?>
