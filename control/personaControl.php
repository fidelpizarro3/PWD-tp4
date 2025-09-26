<?php
include_once __DIR__ . '/../modelo/persona.php';

class PersonaControl {
    private $objPersona;

    public function __construct() {
        $this->objPersona = new Persona();
    }

    // Insertar una persona
    public function insertar($nroDni, $apellido, $nombre, $fechaNac, $telefono, $domicilio) {
        $this->objPersona->setNroDni($nroDni);
        $this->objPersona->setApellido($apellido);
        $this->objPersona->setNombre($nombre);
        $this->objPersona->setFechaNacimiento($fechaNac);
        $this->objPersona->setTelefono($telefono);
        $this->objPersona->setDomicilio($domicilio);

        return $this->objPersona->insertarPersona();
    }

    // Buscar persona por DNI
    public function buscar($nroDni) {
        return $this->objPersona->buscarPersona($nroDni);
    }

    // Modificar datos de una persona
    public function modificar($nroDni, $apellido, $nombre, $fechaNac, $telefono, $domicilio) {
        return $this->objPersona->modificarPersona($nroDni, $apellido, $nombre, $fechaNac, $telefono, $domicilio);
    }

    // Borrar persona por DNI
    public function borrar($nroDni) {
        return $this->objPersona->borrarPersona($nroDni);
    }
}
