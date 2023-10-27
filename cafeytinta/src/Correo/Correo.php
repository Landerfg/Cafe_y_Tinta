<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ruta de la carpeta 'vendor
// Lee las credenciales desde el archivo JSON
$credenciales = json_decode(file_get_contents('../../config/email_config.json'), true);

$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->SMTPDebug = 4;                                 
    $mail->isSMTP();                                      
    $mail->Host       = $credenciales['smtp_host'];  // Especifica el servidor SMTP de IONOS
    $mail->SMTPAuth   = true;                             
    $mail->Username   = $credenciales['smtp_username']; // Tu dirección de correo de IONOS
    $mail->Password   =  $credenciales['smtp_password']; // Tu contraseña de correo de IONOS
    $mail->SMTPSecure =  $credenciales['smtp_secure'];        
    $mail->Port       = $credenciales['smtp_port'];  // Puerto para TLS/STARTTLS

    // Destinatarios
    $mail->setFrom('proyecto@cafeytinta.es', 'Tu Nombre');
    $mail->addAddress('angel142330@gmail.com', 'Miguel'); 

    // Contenido del correo
    $mail->isHTML(true);                                  
    $mail->Subject = 'SIUUU';
    $mail->Body    = 'VPS';

    $mail->send();
    echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Error de envío: {$mail->ErrorInfo}";
}
?>
