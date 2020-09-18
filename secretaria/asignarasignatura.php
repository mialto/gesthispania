<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si' && $_SESSION['rol'] == 'admin'){
    include('../app/nodo.php');
    $id_asignatura = $_GET['id_asignatura'];
    $id_curso = $_GET['id_curso'];
    $mysqli = conexion();
    $sentencia = "UPDATE asignaturas SET activa=1, curso=$id_curso WHERE id=$id_asignatura";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $mysqli->close();
    header('Location: modificarasignaturas?id_curso=' . $id_curso . '');
    
}else{
    header('Location: ../index.php');//=>va a la principal no a datos
}

?>