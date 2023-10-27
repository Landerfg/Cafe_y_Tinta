<?php
// require_once 'Database.php'; 
include ('../config/autoload.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["nombre_usuario"];
    $email = $_POST["correo"];
    $password = $_POST["contrasena"]; // Asegúrate de que el nombre del campo de contraseña en tu formulario coincide con esto

    // Validación de los datos del formulario
    if (empty($usuario)) {
        echo "El nombre de usuario es requerido.";
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $usuario)) {
        echo "El nombre de usuario solo puede contener letras y números.";
    }

    if (empty($email)) {
        echo "El correo electrónico es requerido.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El formato del correo electrónico no es válido.";
    }

    // Cifrado de la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Crea una nueva instancia de la base de datos
    $db = new Database();

    // Prepara la consulta SQL
    $sql="INSERT INTO usuarios (nombre_usuario, correo_usuario, contrasenya_usuario) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$usuario, $email, $hashed_password]);

    // Cierra la conexión
    $db->cerrarConexion();

    // Redirige a la página de inicio de sesión
    header("Location: ../public/html/inicio_sesion.html");
    exit();


}
?>
