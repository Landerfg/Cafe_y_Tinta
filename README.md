# Café y Tinta - Gestión de Proyectos Literarios
Café y Tinta es una aplicación diseñada para la gestión de proyectos literarios, donde los usuarios pueden colaborar en la creación, edición y valoración de proyectos relacionados con libros. A continuación, se detalla la estructura de la base de datos y las principales funcionalidades.

## Estructura de la Base de Datos


```sql
CREATE TABLE usuarios (
  id_usuario INT PRIMARY KEY AUTO_INCREMENT,
  nombre_usuario VARCHAR(255),
  correo_usuario VARCHAR(255),
  contrasenia_usuario VARCHAR(255)
);


CREATE TABLE proyectos (
  id_proyecto INT PRIMARY KEY AUTO_INCREMENT,
  id_usuario_propietario INT,
  titulo_proyecto VARCHAR(255),
  descripcion_proyecto VARCHAR(255),
  privacidad_proyecto  VARCHAR(20),
  FOREIGN KEY (id_usuario_propietario) REFERENCES Usuarios(id_usuario)
);


CREATE TABLE Colaboradores (
  id_usuario_colaborador INT,
  id_proyecto INT,
  id_usuario_propietario INT,
  PRIMARY KEY (id_usuario_colaborador, id_proyecto),
  FOREIGN KEY (id_proyecto) REFERENCES Proyectos(id_proyecto),
  FOREIGN KEY (id_usuario_colaborador) REFERENCES Usuarios(id_usuario),
  FOREIGN KEY (id_usuario_propietario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE Comentarios_proyectos (
  id_comentario INT PRIMARY KEY AUTO_INCREMENT,
  id_usuario_comenta INT,
  id_proyecto_comentado INT,
  contenido_comentario TEXT,
  fecha_comentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_usuario_comenta) REFERENCES Usuarios(id_usuario),
  FOREIGN KEY (id_proyecto_comentado) REFERENCES Proyectos(id_proyecto)
);

CREATE TABLE tokens_reset_contrasenia (
  id_token INT PRIMARY KEY AUTO_INCREMENT,
  id_usuario INT,
  token VARCHAR(255),
  expiration_timestamp INT,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE Comentarios_usuarios (
  id_comentario INT PRIMARY KEY AUTO_INCREMENT,
  id_usuario_comenta INT,
  id_proyecto_comentado INT,
  contenido_comentario TEXT,
  fecha_comentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_usuario_comenta) REFERENCES Usuarios(id_usuario),
  FOREIGN KEY (id_proyecto_comentado) REFERENCES Proyectos(id_proyecto)
);

```

## Funcionalidades Principales
- **Registro de Usuario:** Permite a los usuarios crear una cuenta proporcionando información como `Nombre`, `Correo Electrónico` y `Contraseña`.
- **Recuperación de Contraseña:** Ofrece la posibilidad de restablecer la contraseña mediante un enlace enviado al `Correo Electrónico` del usuario.
- **Eliminación de Usuario:** Permite a los usuarios eliminar su cuenta si lo desean.
- **Creación de Proyecto:** Usuarios pueden crear proyectos, ingresando detalles como `Título`, `Descripción` y configuraciones de `Privacidad`.
- **Compartir Proyecto (Hacer Colaboradores):** Implementa una función que permite a los usuarios agregar colaboradores a sus proyectos, asignándoles roles y permisos específicos.
- **Modificación de Proyectos:** Proporciona a los usuarios la capacidad de editar y actualizar sus propios proyectos, así como proyectos en los que colaboran.
- **Visualización de Proyectos Externos en Modo de Solo Lectura:** Los usuarios pueden ver proyectos de otros usuarios en modo de solo lectura, sin posibilidad de realizar modificaciones.
- **Comentarios en Proyectos:** Permite a los usuarios comentar en proyectos.
- **Valoración de Proyectos:** Proporciona una función de valoración para que los usuarios expresen su aprecio por proyectos específicos.

---

## Extras
  - Foro dudas
  - Pantalla de novedades de Proyectos y usuarios a los que sigues
  - Un usuario puede donar un café a algún proyecto/autor para apoyar
  - valoracion_proyecto CHECK (valoracion_proyecto >= 0 AND valoracion_proyecto <= 3),
