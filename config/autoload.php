<?php

define('DOC_ROOT',dirname(dirname(__FILE__)));

spl_autoload_register(function ($class) {
    $classPath = "../src/"; // Ruta del directorio de clases
    require_once $classPath . $class . ".php";
});


spl_autoload_register(function ($functionFile) {
    $functionPath = "../db/"; // Ruta del directorio de funciones
    $functionFile = $functionPath . $functionFile . ".php";

    if (file_exists($functionFile)) {
        require_once $functionFile;
    }
});

?>