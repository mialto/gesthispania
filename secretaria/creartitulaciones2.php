<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si' && $_SESSION['rol'] == 'admin'){
    if($_POST){
        include('../app/nodo.php');
        $titulacion = $_POST['titulacion'];
        
        $errores = array();

        //limpiamos los campos de posibles inyecciones
        $titulacion = limpiarCampos($titulacion);
 
        //hacemos las validaciones en servidor, of course :)
        if ($titulacion == ""){
            $errores[] = "La titulación no puede estar vacíos";
        } 
        
        $longitud_errores = count($errores);
        if($longitud_errores > 0){
            ?>
            <script>
                alert("Hay errores en el formulario");
            </script>
            <?php
            header("Location: creartitulaciones.php");
        }else{
            $mysqli = conexion();
            $sentencia = "INSERT INTO titulaciones (titulacion) VALUES ('$titulacion')";
            if(!($resultado = $mysqli->query($sentencia))) {
                echo "Error al ejecutar la sentencia <b>$sentencia</b>;: " . $mysqli->error . "\n";
                exit;
            }
            // Libera la memoria ocupada por el resultado
            $mysqli->close();
            header("Location: titulaciones");
            
        }
    }else{
        //enviar a pagina principal
        header("Location: index.php");
    }
}else{
    header('Location: ../index.php');//=>va a la principal no a datos
}

?>