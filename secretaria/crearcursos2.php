<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si'){
    if($_POST){
        include('../app/nodo.php');
        $curso = $_POST['curso'];
        $titulacion = $_POST['titulacion'];
        $duracion = $_POST['duracion'];
        $anno = $_POST['anno'];
        
        $errores = array();

        //limpiamos los campos de posibles inyecciones
        $curso = limpiarCampos($curso);
        $titulacion = limpiarCampos($titulacion);
        $duracion = limpiarCampos($duracion);
        $anno = limpiarCampos($anno);
 
        //hacemos las validaciones en servidor, of course :)
        if ($curso == ""){
            $errores[] = "El curso no puede estar vacío";
        } 
        if ($titulacion == ""){
            $errores[] = "La titulación no puede estar vacíos";
        } 
        
        if ($duracion == ""){
            $errores[] = "La duracion no puede estar vacía";
        } 
        if ($anno == ""){
            $errores[] = "El anno no puede estar vacío";
        } 
        $longitud_errores = count($errores);
        if($longitud_errores > 0){
            ?>
            <script>
                alert("Hay errores en el formulario");
            </script>
            <?php
            header("Location: crearcursos.php");
        }else{
            $mysqli = conexion();
            $pass = md5($pas1);
            $sentencia = "INSERT INTO cursos (curso, titulacion, duracion, anno_academico) VALUES ('$curso','$titulacion','$duracion','$anno')";
            if(!($resultado = $mysqli->query($sentencia))) {
                echo "Error al ejecutar la sentencia <b>$sentencia</b>;: " . $mysqli->error . "\n";
                exit;
            }
            // Libera la memoria ocupada por el resultado
            $mysqli->close();
            header("Location: cursos");
            
        }
    }else{
        //enviar a pagina principal
        header("Location: index.php");
    }
}else{
    header('Location: ../index.php');//=>va a la principal no a datos
}

?>