<?php
class BaseDatos {
    private $host = "localhost";
    private $db = "infoautos";
    private $user = "root";   
    private $pass = "";        
    private $conexion;         
    public function __construct() {
        try {
            $this->conexion = new PDO(
                "mysql:host={$this->host};dbname={$this->db};charset=utf8",
                $this->user,
                $this->pass
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo " Error de conexión: " . $e->getMessage();
        }
    }

    public function getConexion() {
        return $this->conexion;
    }
}
?>
