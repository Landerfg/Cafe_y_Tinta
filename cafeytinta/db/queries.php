<?php

function obtenerUsuarioPorCorreo($conn, $correo)
{
    $stmt = $conn->prepare("SELECT id_usuario, nombre_usuario, contrasenya_usuario, correo_usuario FROM usuarios WHERE correo_usuario = ?");
    $stmt->execute([$correo]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function verificarToken($conn, $token)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM tokens WHERE token = ? AND fecha_expiracion > NOW()");
        $stmt->execute([$token]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        // Manejar la excepción según tus necesidades
        throw new Exception("Error al verificar el token: " . $e->getMessage());
    }
}

function registrarUsuario($conn, $usuario, $email, $hashed_password)
{
    try {
        // Verificar si el correo electrónico ya está registrado
        $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE correo_usuario = ?");
        $stmt->execute([$email]);
        $existingUser = $stmt->fetch();

        if ($existingUser) {
            // El correo electrónico ya está registrado, puedes manejar esto según tus necesidades
            throw new Exception("El correo electrónico ya está registrado.");
        }

        // Insertar el nuevo usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, correo_usuario, contrasenya_usuario) VALUES (?, ?, ?)");
        $stmt->execute([$usuario, $email, $hashed_password]);

        return true; // Registro exitoso
    } catch (PDOException $e) {
        // Manejar el error de la base de datos según tus necesidades
        throw new Exception("Error al registrar el usuario: " . $e->getMessage());
    }
}

function enviarCorreoRestablecerContrasena($conn, $username, $email)
{
    try {
        // Verificar si el usuario existe en la base de datos
        $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE nombre_usuario = ?");
        $stmt->execute([$username]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            // El usuario no existe, puedes manejar esto según tus necesidades
            throw new Exception("El usuario no existe.");
        }

        // Generar un token único
        $token = bin2hex(random_bytes(50));

        // Insertar el token en la base de datos
        $stmt = $conn->prepare("INSERT INTO tokens (id_usuario, correo, token, fecha_expiracion) VALUES (?, ?, ?, DATE_ADD(NOW(), INTERVAL 30 MINUTE))");
        $stmt->execute([$usuario['id_usuario'], $email, $token]);

        // Configuración de PHPMailer
        // ...

        // Intentar enviar el correo electrónico
       // $mail->send();

        return true; // Correo enviado exitosamente
    } catch (PDOException $e) {
        // Manejar el error de la base de datos
        throw new Exception("Error de la base de datos: " . $e->getMessage());
    } catch (Exception $e) {
        // Manejar el error al enviar el correo electrónico
        throw new Exception("Error al enviar el correo electrónico: " . $e->getMessage());
    }
}
