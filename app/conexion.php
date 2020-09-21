<?php
function conexion(){
    // Conecta con el servidor de MySQL
    $mysqli = @new mysqli(
    "localhost", // El servidor
    "root", // El usuario
    "", // La contraseña
    "gesthispania"); // La base de datos
    if(mysqli_connect_errno()) {
    echo "Error al conectar con la base de datos: " . mysqli_connect_error() ."
    ";
    exit;
    }
    $mysqli->set_charset("utf8");
    return $mysqli;
 
}
?>