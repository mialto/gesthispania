<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si'){
    include('../app/nodo.php');
    $id_usuario = $_GET['id_usuario'];
    $id_asignatura = $_GET['id_asignatura'];
    $accion = $_GET['accion'];
    if($accion == 'si'){
        $mysqli = conexion();
        $sentencia = "INSERT INTO matriculaciones (id_usuario, id_asignatura) VALUES ('$id_usuario','$id_asignatura')";
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "Error al ejecutar la sentencia <b>$sentencia</b>;: " . $mysqli->error . "\n";
            exit;
        }
        $mysqli->close();
        
        header('Location: index');
    }elseif($accion == 'no'){
        $mysqli = conexion();
        $sentencia = "DELETE FROM matriculaciones WHERE id_usuario=$id_usuario AND id_asignatura=$id_asignatura";
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "Error al ejecutar la sentencia <b>$sentencia</b>;: " . $mysqli->error . "\n";
            exit;
        }
        $mysqli->close();
        
        header('Location: index');
    }else{
        header('Location: index');
        
    }
    //
}else{
    header('Location: ../index.php');//=>va a la principal no a datos
}

?>