-- Active: 1697799391204@@cafeytinta.es@3306@cafeytinta
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT COMMENT 'id de los usuarios ',
  `nombre_usuario` varchar(100) NOT NULL,
  `contrasenya_usuario` varchar(100) NOT NULL,
  `correo_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ;

CREATE TABLE `categorias_genero` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
);


CREATE TABLE `proyectos` (
  `id_proyecto` int NOT NULL AUTO_INCREMENT,
  `id_usuario_propietario` int DEFAULT NULL,
  `titulo_proyecto` varchar(255) DEFAULT NULL,
  `descripcion_proyecto` text,
  `privacidad_proyecto` enum('privado','público') DEFAULT 'privado',
  `id_categoria_genero` int DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_proyecto`),
  CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`id_usuario_propietario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `proyectos_ibfk_2` FOREIGN KEY (`id_categoria_genero`) REFERENCES `categorias_genero` (`id_categoria`)
);

CREATE TABLE `notif` (
  `id_notificacion` int NOT NULL AUTO_INCREMENT,
  `autor` text NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_proyecto` int NOT NULL,
  PRIMARY KEY (`id_notificacion`),
  CONSTRAINT `FK_id_proyecto_notif` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`)
);

CREATE TABLE `notif_usuarios` (
  `id_notificacion` int NOT NULL,
  `id_usuario` int NOT NULL,
  `estado` int DEFAULT '0',
  PRIMARY KEY (`id_notificacion`,`id_usuario`),
  CONSTRAINT `FK_notif` FOREIGN KEY (`id_notificacion`) REFERENCES `notif` (`id_notificacion`),
  CONSTRAINT `FK_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
);

CREATE TABLE `tokens` (
  `id_token` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `fecha_expiracion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_token`),
  CONSTRAINT `fk_tokens_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
);



CREATE TABLE `comentarios_usuarios` (
  `id_comentario` int NOT NULL AUTO_INCREMENT,
  `id_usuario_comenta` int NOT NULL,
  `id_usuario_comentado` int NOT NULL,
  `contenido_comentario` text,
  `fecha_comentario` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comentario`),
  CONSTRAINT `comentarios_usuarios_ibfk_1` FOREIGN KEY (`id_usuario_comenta`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `comentarios_usuarios_ibfk_2` FOREIGN KEY (`id_usuario_comentado`) REFERENCES `usuarios` (`id_usuario`)
);

CREATE TABLE `comentarios_proyectos` (
  `id_comentario` int NOT NULL AUTO_INCREMENT,
  `id_usuario_comenta` int DEFAULT NULL,
  `id_proyecto_comentado` int DEFAULT NULL,
  `contenido_comentario` text,
  `fecha_comentario` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comentario`),
  CONSTRAINT `comentarios_proyectos_ibfk_1` FOREIGN KEY (`id_usuario_comenta`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `comentarios_proyectos_ibfk_2` FOREIGN KEY (`id_proyecto_comentado`) REFERENCES `proyectos` (`id_proyecto`)
) ;


CREATE TABLE `colaboradores` (
  `id_usuario_colaborador` int NOT NULL,
  `id_proyecto` int NOT NULL,
  `id_usuario_propietario` int DEFAULT NULL,
  PRIMARY KEY (`id_usuario_colaborador`,`id_proyecto`),
  CONSTRAINT `colaboradores_ibfk_1` FOREIGN KEY (`id_usuario_colaborador`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `colaboradores_ibfk_2` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`),
  CONSTRAINT `colaboradores_ibfk_3` FOREIGN KEY (`id_usuario_propietario`) REFERENCES `usuarios` (`id_usuario`)
);

