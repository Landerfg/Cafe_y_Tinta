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

function obtenerProyectosUsuario($conn, $id_usuario)
{
    $stmt = $conn->prepare("SELECT * FROM proyectos WHERE id_usuario_propietario = ?");
    $stmt->execute([$id_usuario]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



function obtenerNotificacionesUsuario($conn, $id_usuario)
{
    $stmt = $conn->prepare("
        SELECT n.*
        FROM notif n
        JOIN notif_usuarios nu ON n.id_notificacion = nu.id_notificacion
        WHERE nu.id_usuario = ? AND nu.estado = 0
        ORDER BY n.fecha_creacion DESC
        LIMIT 3
    ");
    $stmt->execute([$id_usuario]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerTokenPorTokenYFecha($db, $token)
{
    $stmt = $db->prepare("SELECT * FROM tokens WHERE token = ? AND fecha_expiracion > NOW()");
    $stmt->execute([$token]);
    return $stmt->fetch();
}


function actualizarContrasena($db, $hashed_password, $id_usuario)
{
    $stmt = $db->prepare("UPDATE usuarios SET contrasenya_usuario = ? WHERE id_usuario = ?");
    $stmt->execute([$hashed_password, $id_usuario]);
}

function eliminarToken($db, $token)
{
    $stmt = $db->prepare("DELETE FROM tokens WHERE token = ?");
    $stmt->execute([$token]);
}


function obtenerProyectoPorId($conn, $id_proyecto)
{
    $sql = "SELECT * FROM proyectos WHERE id_proyecto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_proyecto]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function obtenerNombreCategoriaPorId($conn, $id_categoria_genero)
{
    $sql = "SELECT nombre_categoria FROM categorias_genero WHERE id_categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_categoria_genero]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró la categoría antes de acceder al nombre
    return ($resultado !== false) ? $resultado['nombre_categoria'] : null;
}


function obtenerIdCategoriaPorNombre($conn, $nombre_categoria)
{
    $sql = "SELECT id_categoria FROM categorias_genero WHERE nombre_categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nombre_categoria]);
    return $stmt->fetchColumn();
}

function insertarProyecto($conn, $id_usuario_propietario, $titulo_proyecto, $descripcion_proyecto, $id_categoria_genero)
{
    $sql = "INSERT INTO proyectos (id_usuario_propietario, titulo_proyecto, descripcion_proyecto, id_categoria_genero) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id_usuario_propietario, $titulo_proyecto, $descripcion_proyecto, $id_categoria_genero]);
}


function crearProyecto($conn, $id_usuario_propietario, $titulo_proyecto, $descripcion_proyecto, $id_categoria_genero)
{
    $sql = "INSERT INTO proyectos (id_usuario_propietario, titulo_proyecto, descripcion_proyecto, id_categoria_genero) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_usuario_propietario, $titulo_proyecto, $descripcion_proyecto, $id_categoria_genero]);
    return $conn->lastInsertId();
}

function crearNotificacion($conn, $autor, $mensaje, $id_proyecto)
{
    $sql = "INSERT INTO notif (autor, mensaje, id_proyecto) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$autor, $mensaje, $id_proyecto]);
    return $conn->lastInsertId();
}

function notificarUsuarios($conn, $id_notificacion, $usuarios)
{
    foreach ($usuarios as $usuario) {
        $sql = "INSERT INTO notif_usuarios (id_notificacion, id_usuario, estado) VALUES (?, ?, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_notificacion, $usuario['id_usuario']]);
    }
}

function obtenerTodosLosUsuarios($conn)
{
    $sql = "SELECT id_usuario FROM usuarios";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function marcarNotificacionComoVista($conn, $notificacionId, $id_usuario) {
    $stmt = $conn->prepare("UPDATE notif_usuarios SET estado = 1 WHERE id_notificacion = ? AND id_usuario = ?");
    $stmt->execute([$notificacionId, $id_usuario]);
}