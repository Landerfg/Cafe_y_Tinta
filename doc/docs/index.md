# 🖥️ Bienvenido a Cafe&Tinta

## 🛠 Configuración del Servidor Apache

> ⚠️ **¡No te fies de estos apuntes!**

### 🔧 `/etc/hosts`
- **Objetivo**: Mapear direcciones IP a nombres de host.

### 🔧 `/etc/apache2/apache2.conf`
- **Objetivo**: Este archivo contiene la configuración principal de Apache.

### 🔧 `/etc/apache2/ports.conf`
- **Objetivo**: Define los puertos en los que Apache escuchará las conexiones. Por defecto, incluye configuraciones para el puerto 80 (HTTP) y 443 (HTTPS).

## 📁 Directorios Clave

### 🔧 `/etc/apache2/sites-available/`
- **Objetivo**: En este directorio, encontrarás archivos de configuración para sitios web específicos. Puedes habilitar o deshabilitar sitios moviendo enlaces simbólicos a `/etc/apache2/sites-enabled/`.

### 🔧 `/etc/apache2/sites-enabled/`
- **Objetivo**: Contiene enlaces simbólicos a archivos de configuración de sitios en `sites-available/`. Los sitios aquí están activos.

**Habilitar configuración:**
<font color="blue"><u>*a2ensite 001.DAW.conf*</u></font><br>
> ⚠️ **¡Reinicia siempre el servidor!** <br>
⏳ 
<font color="blue"><u>*sudo systemctl restart apache2*</u></font><br>
### 🔧 `/var/www/html/`
- **Objetivo**: Directorio predeterminado para archivos de sitios web. Puedes cambiar la ubicación del directorio raíz en los archivos de configuración.

## 📊 Registro de Acceso y Autenticación

### 🔧 `/var/log/apache2/access.log`
- **Objetivo**: Registro de solicitudes de acceso al servidor.

### 🔧 `/var/log/auth.log`
- **Objetivo**: Registro de autenticación del sistema.

## 💻 Comandos SSH y SCP

### Acceder al servidor SSH

### 🔐 `ssh usuario@midominio`
Establecer una conexión segura con un servidor remoto

### 🔐 `scp index.html usuario@midominio:/var/www/html/`
(Secure Copy) para copiar el archivo index.html desde tu máquina local al directorio /var/www/html/ en el servidor remoto.
