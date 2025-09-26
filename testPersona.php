<?php


include_once "modelo/persona.php";

$persona1 = new Persona();

$persona1->setNroDni("555555");
$persona1->setNombre("fidel");
$persona1->setApellido("pizarro");
$persona1->setFechaNacimiento("2004-10-21");
$persona1->setTelefono("23342323");
$persona1->setDomicilio("neuquen");

if($persona1->InsertarPersona()){
    echo "pérsona insertada correctamente";
}
else {
    echo "no se pudo insertar a la persona";
}

$persona1->borrarPersona("555555");