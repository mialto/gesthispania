<?php
session_start();
if($_SESSION['logado'] == 'no' && isset($_POST['email'])){
    include("app/conexion.php");
    include("app/controller.php");
    $email = $_POST['email'];
    $email = limpiarCampos($email);
    $pass = limpiarCampos($_POST['pass']);
    $pass = md5($pass);
    $mysqli = conexion();
    $sentencia = "SELECT * FROM usuarios WHERE email='$email' AND pass='$pass'";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $numfilas = $resultado->num_rows;
    if($numfilas > 0){
        while($fila = $resultado->fetch_array()) {
            $_SESSION['logado'] = 'si';
            $_SESSION['nombre'] = $fila['nombre'];
            $_SESSION['apellidos'] = $fila['apellidos'];
            $_SESSION['email'] = $fila['email'];
            $_SESSION['rol'] = $fila['rol'];
            $_SESSION['id'] = $fila['id'];
        }
        header("Location: secretaria/");
    }else{
        header("Location: index.php?error='1'");
    }
    $resultado->close();
    $mysqli->close();

}else{
    header("Location: index.php");
}
?>
