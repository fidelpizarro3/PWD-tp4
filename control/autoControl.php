<?php


include_once __DIR__ . '/../Model/auto.php';
include_once __DIR__ . '/../Model/Conexion/baseDatos.php';
class AutoControl {
    private $objAuto;

    public function __construct() {
        $this->objAuto = new Auto();
    }

    // Insertar un auto
    public function insertar($patente, $marca, $modelo, $dniDuenio) {
        $this->objAuto->setPatente($patente);
        $this->objAuto->setMarca($marca);
        $this->objAuto->setModelo($modelo);
        $this->objAuto->setDniDuenio($dniDuenio);
        return $this->objAuto->insertarAuto();
    }

    // Buscar auto por patente
    public function buscar($patente) {
    $auto = null;
    try {
        $sql = "SELECT a.Patente, a.Marca, a.Modelo, p.Nombre, p.Apellido
                FROM auto a
                JOIN persona p ON a.DniDuenio = p.NroDni
                WHERE a.Patente = :patente";
        $db = new BaseDatos();
        $conn = $db->getConexion();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':patente', $patente);
        $stmt->execute();
        $auto = $stmt->fetch(PDO::FETCH_ASSOC); // devuelve un array
    } catch (PDOException $e) {
        $e->getMessage();
    }
    return $auto;
}

    //Buscar auto por dni duenio
    public function buscarPorDni($dniDuenio) {
        return $this->objAuto->buscarAutoPorDni($dniDuenio);
    }

    // Modificar datos de un auto
    public function modificar($patente, $marca, $modelo, $dniDuenio) {
        return $this->objAuto->modificarAuto($patente, $marca, $modelo, $dniDuenio);
    }

    // Borrar auto por patente
    public function borrar($patente) {
        return $this->objAuto->borrarAuto($patente);
    }

    // Listamos autos con datos del dueño
    public function listarAutoConDuenio() {
    $autos = [];
    try {
        $sql = "SELECT a.Patente, a.Marca, a.Modelo, p.Nombre, p.Apellido
                FROM auto a
                JOIN persona p ON a.DniDuenio = p.NroDni";
        $db = new BaseDatos();
        $conn = $db->getConexion();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $autos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $e->getMessage();
    }
        return $autos;
    }

    public function cambiarDuenio($patente, $dniNuevoDuenio) {
    return $this->objAuto->cambiarDuenio($patente, $dniNuevoDuenio);
}

}