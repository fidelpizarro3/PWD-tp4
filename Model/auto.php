<?php

class Auto {
    private $patente;
    private $marca;
    private $modelo;
    private $dniDuenio;
    private $conn;

    public function __construct() {
    $bd = new BaseDatos();          // crea el objeto BaseDatos
    $this->conn = $bd->getConexion(); // guarda la conexión PDO
}

    //GETTERS
    public function getPatente() {
        return $this->patente;
    }   
    public function getMarca() {
        return $this->marca;
    }
    public function getModelo() {
        return $this->modelo;
    }
    public function getDniDuenio() {
        return $this->dniDuenio;
    }
    

    //SETTERS
    public function setPatente($patente) {
        $this->patente = $patente;
    }
    public function setMarca($marca) {
        $this->marca = $marca;
    }
    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }
    public function setDniDuenio($dniDuenio) {
        $this->dniDuenio = $dniDuenio;
    }

public function InsertarAuto(){
    $resultado = false;
    try {
        $sql = "INSERT INTO auto (Patente,Marca,Modelo,DniDuenio)
            VALUES (:patente, :marca, :modelo, :dniDuenio)";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':patente', $this->getPatente());
            $stmt->bindParam(':marca', $this->getMarca());
            $stmt->bindParam(':modelo', $this->getModelo());
            $stmt->bindParam(':dniDuenio', $this->getDniDuenio());
        
            if($stmt->execute()) {
                $resultado = true;
            }
    } catch (PDOException $e) {
        $e->getMessage();
    }
    return $resultado;
}
    public function borrarAuto($patente) {
        $resultado = false;
        try {
            $sql = "DELETE FROM auto WHERE Patente = :patente";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':patente', $patente);
            if($stmt->execute()) {
                $resultado = true;
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
        return $resultado;
    }

    public function modificarAuto($patente, $marca, $modelo, $dniDuenio) {
        $resultado = false;
        try {
            $sql = "UPDATE auto 
                    SET Marca = :marca, Modelo = :modelo, DniDuenio = :dniDuenio 
                    WHERE Patente = :patente";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':patente', $patente);
            $stmt->bindParam(':marca', $marca);
            $stmt->bindParam(':modelo', $modelo);
            $stmt->bindParam(':dniDuenio', $dniDuenio);
            if($stmt->execute()) {
                $resultado = true;
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
        return $resultado;
    }

    public function buscarAuto($patente) {
        $auto = null;
        try {
            $sql = "SELECT * FROM auto WHERE Patente = :patente";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':patente', $patente);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                $auto = new Auto();
                $auto->setPatente($resultado['Patente']);
                $auto->setMarca($resultado['Marca']);
                $auto->setModelo($resultado['Modelo']);
                $auto->setDniDuenio($resultado['DniDuenio']);
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
        return $auto;
    }

    public function buscarAutoPorDni($dniDuenio) {
        $autos = [];
        try {
            $sql = "SELECT * FROM auto WHERE DniDuenio = :dniDuenio";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':dniDuenio', $dniDuenio);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $auto = new Auto();
                $auto->setPatente($row['Patente']);
                $auto->setMarca($row['Marca']);
                $auto->setModelo($row['Modelo']);
                $auto->setDniDuenio($row['DniDuenio']);
                $autos[] = $auto;
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
        return $autos;
    }

    public function cambiarDuenio($patente, $dniNuevoDuenio) {
    try {
        $sql = "UPDATE auto SET DniDuenio = :dni WHERE Patente = :patente";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":dni", $dniNuevoDuenio);
        $stmt->bindParam(":patente", $patente);
        return $stmt->execute();
    } catch (PDOException $e) {
         $e->getMessage();
        return false;
    }
}

}