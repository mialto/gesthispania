<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si'){
    if($_POST){
        include('../app/nodo.php');
        $nombre = $_POST['nombre'];
        $creditos = $_POST['creditos'];
        $duracion = $_POST['duracion'];
        $curso = $_POST['curso'];
        
        $errores = array();

        //limpiamos los campos de posibles inyecciones
        $nombre = limpiarCampos($nombre);
        $creditos = limpiarCampos($creditos);
        $duracion = limpiarCampos($duracion);
        $curso = limpiarCampos($curso);
 
        //hacemos las validaciones en servidor, of course :)
        if ($nombre == ""){
            $errores[] = "El nombre no puede estar vacío";
        } 
        if ($creditos == ""){
            $errores[] = "Los créditos no pueden estar vacíos";
        } 
        
        if ($duracion == ""){
            $errores[] = "La duracion no puede estar vacía";
        } 
        if ($curso == ""){
            $errores[] = "El curso no puede estar vacío";
        } 
        $longitud_errores = count($errores);
        if($longitud_errores > 0){
            ?>
            <script>
                alert("Hay errores en el formulario");
            </script>
            <?php
            header("Location: asignaturas.php");
        }else{
            $mysqli = conexion();
            $sentencia = "INSERT INTO asignaturas (nombre, creditos, duracion, curso, activa) VALUES ('$nombre','$creditos','$duracion','$curso', '1')";
            if(!($resultado = $mysqli->query($sentencia))) {
                echo "Error al ejecutar la sentencia <b>$sentencia</b>;: " . $mysqli->error . "\n";
                exit;
            }
            // Libera la memoria ocupada por el resultado
            $mysqli->close();
            header("Location: asignaturas");
            
        }
    }else{
        //enviar a pagina principal
        header("Location: index.php");
    }
}else{
    header('Location: ../index.php');//=>va a la principal no a datos
}

?>