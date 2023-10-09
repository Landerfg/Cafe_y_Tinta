# Cafe_y_Tinta
Proyecto Café y Tinta

Entidades
  - Usuarios -> PK_IDusuario, Nombre, contraseña, correo, FK_IDproyecto_colaborador
  - Proyectos -> PK_IDproyecto, FK_propietario, FK_colaboradores, fecha_modificaciones, FK_ID_Usuario_modificador 

Historia de Usuario
  - Un usuario puede registrarse
  - Un usuario puede recuperar contraseña
  - Un usuario puede borrar su usuario
  - Un usuario puede crear un proyecto
  - Un usuario puede compartir el proyecto (Hacer colaboradores)
  - Un usuario puede modificar proyectos propios o de colaboradores
  - Un usuario puede ver proyectos externos en solo lectura (No siendo colaborador)
  - Un usuario puede comentar proyectos de los que no es colaborador
  - Un usuario puede puede seguir proyectos ajenos y a otros usuarios
  - Un usuario puede valorar proyectos y mostrar mejores valorados

Extras
  - Foro dudas
  - Pantalla de novedades de Proyectos y usuarios a los que sigues
  - Un usuario puede donar un café a algún proyecto/autor para apoyar
