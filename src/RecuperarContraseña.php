<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// require_once 'Database.php';
include('../config/autoload.php');
include('PHPMailerSingleton.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? null;
    $email = $_POST["email"] ?? null;

    // COMPROBAR SI EXISTE EN BD
    if ($username !== null && $email !== null) {
        $token = bin2hex(random_bytes(50));

        $db = Database::getInstance();

        $stmt = $db->prepare("SELECT * FROM usuarios WHERE nombre_usuario =?");
        $stmt->execute([$username]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


        $stmt = $db->prepare("INSERT INTO tokens (id_usuario, correo, token, fecha_expiracion) VALUES (?, ?, ?, DATE_ADD(NOW(), INTERVAL 30 MINUTE))");
        $stmt->execute([$usuario['id_usuario'], $email, $token]);

        // Configuración de PHPMailer

        // Obtener la instancia de PHPMailer
        $correo = PHPMailerSingleton::getInstance();

        $correo->addAddress($email, $username);

        // Contenido del correo
        $correo->Subject = 'Restablecer';
        $correo->Body = 'Para restablecer tu contraseña, haz clic en este enlace: <a href="http://cafeytinta.es/src/RestablecerContraseña.php?token=' . $token . '">Restablecer Contraseña</a>';

        try {
            $correo->send();
            echo 'Se ha enviado un correo electrónico a la dirección indicada. Por favor, comprueba tu bandeja de entrada.';
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Error de envío: {$correo->ErrorInfo}";
        } finally {
            $db->cerrarConexion();
        }
    } else {
        echo "Error: Campos 'username' y 'email' no presentes en la solicitud.";
    }
} else {
    echo "Error: Esta página solo acepta solicitudes POST.";
}

header("Location: ../public/html/exito.html");
exit;
