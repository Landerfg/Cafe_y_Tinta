# Café y Tinta - Gestión de Proyectos Literarios
Café y Tinta es una aplicación diseñada para la gestión de proyectos literarios, donde los usuarios pueden colaborar en la creación, edición y valoración de proyectos relacionados con libros. A continuación, se detalla la estructura de la base de datos y las principales funcionalidades.

## Estructura de la Base de Datos

### Usuarios
- **id_usuario (Clave Primaria)**
- Nombre
- Contraseña
- Correo

### Proyectos
- **id_proyecto (Clave Primaria)**
- **id_propietario (Clave Externa)**: Referencia al propietario del proyecto (id_usuario).
- TituloProyecto
- DescripcionProyecto
- PrivacidadProyecto

### Roles
- **id_rol (Clave Primaria)**
- NombreRol

### Colaboradores
- **id_colaborador (Clave Primaria)**
- **id_proyecto (Clave Externa)**: Referencia al proyecto (id_proyecto).
- **id_colaborador (Clave Externa)**: Referencia al colaborador (id_usuario).
- **id_rol (Clave Externa)**: Referencia al rol asignado al colaborador (id_rol).

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
