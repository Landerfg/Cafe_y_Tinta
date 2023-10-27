<?php
require_once '../src/Database.php';

$db = new Database();

// Eliminar tokens expirados
$stmt = $db->prepare("DELETE FROM tokens WHERE fecha_expiracion <= NOW()");
$stmt->execute();


?>
