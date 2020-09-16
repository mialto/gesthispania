<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si'){
    if($_POST){
        include('../app/nodo.php');
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $mail = $_POST['email'];
        $pas1 = $_POST['password'];
        $pas2 = $_POST['repassword'];
        
        $errores = array();
        //comprobamos que pas1 y pas2 son el mismo
        if($pas1 != $pas2){
            $errores[] = "Las contraseñas no coinciden";
        }

        //limpiamos los campos de posibles inyecciones
        $nombre = limpiarCampos($nombre);
        $apellidos = limpiarCampos($apellidos);
        $mail = limpiarCampos($mail);
        $pas1 = limpiarCampos($pas1);
 
        //hacemos las validaciones en servidor, of course :)
        if ($nombre == ""){
            $errores[] = "El nombre no puede estar vacío";
        } 
        if (!preg_match("/^[a-záéíóúA-ZÁÉÍÓÚ ]*$/", $nombre)){
            $errores[] = "El nombre tiene carácteres prohibidos";
        }
        if ($apellidos == ""){
            $errores[] = "Los apellidos no pueden estar vacíos";
        } 
        if (!preg_match("/^[a-záéíóúA-ZÁÉÍÓÚ ]*$/", $apellidos)){
            $errores[] = "Los apellidos tienen carácteres prohibidos";
        }
        if ($mail == ""){
            $errores[] = "El correo no puede estar vacío";
        } 
        if ($pas1 == ""){
            $errores[] = "La contraseña no puede estar vacío";
        } 
        $longitud_errores = count($errores);
        if($longitud_errores > 0){
            ?>
            <script>
                alert("Hay errores en el formulario");
            </script>
            <?php
            header("Location: registro.php");
        }else{
            $mysqli = conexion();
            $pass = md5($pas1);
            $id = $_SESSION['id'];
            $sentencia = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', email='$mail', pass='$pass' WHERE id=$id";
            //$sentencia = "INSERT INTO usuarios (nombre, apellidos, email, pass, rol) VALUES ('$nombre','$apellidos','$mail','$pass', 'usuario')";
            if(!($resultado = $mysqli->query($sentencia))) {
                echo "Error al ejecutar la sentencia <b>$sentencia</b>;: " . $mysqli->error . "\n";
                exit;
            }
            // Libera la memoria ocupada por el resultado
            $mysqli->close();
            header("Location: perfil");
            
        }
    }else{
        //enviar a pagina principal
        header("Location: index.php");
    }
}else{
    header('Location: ../index.php');//=>va a la principal no a datos
}

?>