<?php
class Database
{
    private $config;
    private $conect;

    public function __construct()
    {
        $this->config = json_decode(file_get_contents('../config/db.json'), true);

        try {
            $this->conect = new PDO("mysql:host={$this->config['host']};dbname={$this->config['db']};charset={$this->config['charset']}", $this->config['user'], $this->config['pass']);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo 'Conexión exitosa';
        } catch (PDOException $e) {
          
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function prepare($sql) {
        
        return  $this->conect->prepare($sql);

    }
    public function getConexion()
    {
        return $this->conect;
    }

    public function cerrarConexion()
    {
        $this->conect = null;
    }

    public function lastInsertId() {
        return $this->conect->lastInsertId();
    }
}
