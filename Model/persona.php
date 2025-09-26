<?php
include_once __DIR__ . '/Conexion/baseDatos.php';

class Persona {
    private $nroDni;
    private $apellido;
    private $nombre;
    private $fechaNac;
    private $telefono;
    private $domicilio;
    private $conn;

    public function __construct() {
    $bd = new BaseDatos();          // crea el objeto BaseDatos
    $this->conn = $bd->getConexion(); // guarda la conexión PDO
}

    //GETTERS
    public function getNroDni() {
        return $this->nroDni;
    }   
    public function getApellido() {
        return $this->apellido;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getFechaNac() {
        return $this->fechaNac;
    }
    public function getTelefono() {
        return $this->telefono;
    }
    public function getDomicilio() {
        return $this->domicilio;
    }
    

    //SETTERS
    public function setNroDni($nroDni) {
        $this->nroDni = $nroDni;
    }
    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setFechaNacimiento($fechaNac) {
        $this->fechaNac = $fechaNac;
    }
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    public function setDomicilio($domicilio) {
        $this->domicilio = $domicilio;
    }

public function InsertarPersona(){
    try {
        $sql = "INSERT INTO persona (NroDni,Apellido,Nombre,FechaNac,Telefono,Domicilio)
            VALUES (:nroDni, :apellido, :nombre, :fechaNac, :telefono, :domicilio)";

            $stmt = $this->conn->prepare($sql);

            $dni = $this->getNroDni();
            $apellido = $this->getApellido();
            $nombre = $this->getNombre();
            $fechaNac = $this->getFechaNac();
            $telefono = $this->getTelefono();
            $domicilio = $this->getDomicilio();


            $stmt->bindParam(':nroDni', $dni);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':fechaNac', $fechaNac);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':domicilio', $domicilio);
        
            if($stmt->execute()){
                $insercion = true;
            }
            else{
                $insercion = false;
            }
        
        }

        catch(PDOException $e){
            $e->getMessage();
            $insercion = false;
        }
        return $insercion;  
    }


    public function borrarPersona($nroDni) {
        try{
            $sql = "DELETE FROM persona WHERE NroDni = :nroDni";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(":nroDni", $nroDni);

            if($stmt->execute()){
                $resultado = true;
            }
        }
        catch(PDOException $e){
            $e->getMessage();
        }
        return $resultado;

    }
    


    public function modificarpersona($nroDni, $apellido, $nombre, $fechaNac, $telefono, $domicilio) {
        $modificado = false;
        try {
            $sql = "UPDATE persona 
                    SET Apellido = :apellido, 
                    Nombre = :nombre, 
                    FechaNac = :fechaNac, 
                    Telefono = :telefono, 
                    Domicilio = :domicilio
                    WHERE NroDni = :nroDni";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':nroDni', $nroDni);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':fechaNac', $fechaNac);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':domicilio', $domicilio);

            if($stmt->execute()){
                $modificado = true;
            }
        
        } catch(PDOException $e) {
            $e->getMessage();
            $modificado = false;
        }
        return $modificado;
    }

    public function buscarpersona($nroDni) {
        $persona = null;
        try {
            $sql = "SELECT * FROM persona WHERE NroDni = :nroDni";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nroDni', $nroDni);
            $stmt->execute();

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $persona = new Persona();
                $persona->setNroDni($row['NroDni']);
                $persona->setApellido($row['Apellido']);
                $persona->setNombre($row['Nombre']);
                $persona->setFechaNacimiento($row['fechaNac']);
                $persona->setTelefono($row['Telefono']);
                $persona->setDomicilio($row['Domicilio']);
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
        return $persona;
    }

    public function listarPersonas() {
    $personas = [];
    try {
        $sql = "SELECT * FROM persona";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $p = new Persona();
            $p->setNroDni($row['NroDni']);
            $p->setApellido($row['Apellido']);
            $p->setNombre($row['Nombre']);
            $p->setFechaNacimiento($row['fechaNac']);
            $p->setTelefono($row['Telefono']);
            $p->setDomicilio($row['Domicilio']);

            $personas[] = $p;
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
    return $personas;
}
}

