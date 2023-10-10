# Café y Tinta - Gestión de Proyectos Literarios
Café y Tinta es una aplicación diseñada para la gestión de proyectos literarios, donde los usuarios pueden colaborar en la creación, edición y valoración de proyectos relacionados con libros. A continuación, se detalla la estructura de la base de datos y las principales funcionalidades.

## Estructura de la Base de Datos


```sql
CREATE TABLE Usuarios (
  id_usuario INT PRIMARY KEY AUTO_INCREMENT,
  nombre_usuario VARCHAR(255),
  correo_usuario VARCHAR(255),
  contrasenia_usuario VARCHAR(255)
);


CREATE TABLE Proyectos (
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
  es_editor BOOLEAN,
  PRIMARY KEY (id_usuario_colaborador, id_proyecto),
  FOREIGN KEY (id_proyecto) REFERENCES Proyectos(id_proyecto),
  FOREIGN KEY (id_usuario_colaborador) REFERENCES Usuarios(id_usuario)
);
...


## Relaciones
- La tabla `Colaboradores` establece la relación entre usuarios y proyectos, asignando roles específicos a los colaboradores en esos proyectos.
- Las claves foráneas en la tabla `Colaboradores` se relacionan con las claves primarias de las tablas `Proyectos`, `Usuarios` y `Roles`, respectivamente.

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


## Entidades
 **Usuarios**

Historia de Usuario
  - **Registro de Usuario:**  usuarios puedan crear una cuenta proporcionando la información necesaria, como nombre, correo electrónico y contraseña.
  - **Recuperación de Contraseña:** restablecer su contraseña mediante un enlace enviado a su correo electrónico.
  - **Eliminación de Usuario:** una función que permita a los usuarios eliminar su cuenta si lo desean.
  - **Creación de Proyecto:**  usuarios crean proyectos, ingresando detalles como título, descripción y configuraciones de privacidad (public ,private ,colaboradores).
  - **Compartir Proyecto (Hacer Colaboradores):** implementa una función que permita a los usuarios agregar colaboradores a sus proyectos, asignándoles roles y permisos específicos.
  - **Modificación de Proyectos:** proporciona a los usuarios la capacidad de editar y actualizar sus propios proyectos, así como proyectos en los que colaboran.
  - **Visualización de Proyectos Externos en Modo de Solo Lectura:**  los usuarios puedan ver proyectos de otros usuarios en modo de solo lectura, sin posibilidad de realizar modificaciones.
  - **Comentarios en Proyectos:**
  - **Seguir Proyectos y Otros Usuarios:**
  - **Valoración de Proyectos:** Proporciona una función de valoración para que los usuarios puedan expresar su aprecio por proyectos específicos. 

Extras
  - Foro dudas
  - Pantalla de novedades de Proyectos y usuarios a los que sigues
  - Un usuario puede donar un café a algún proyecto/autor para apoyar
