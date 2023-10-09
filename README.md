# Cafe_y_Tinta
Proyecto Café y Tinta

Entidades
  - Usuarios -> PK_IDusuario, Nombre, contraseña, correo, FK_IDproyecto_colaborador
  - Proyectos -> PK_IDproyecto, FK_propietario, FK_colaboradores, fecha_modificaciones, FK_ID_Usuario_modificador 

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
