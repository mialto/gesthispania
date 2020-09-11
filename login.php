<?php
session_start();
if($_SESSION['logado'] == 'no' && isset($_POST['email'])){
    include("app/conexion.php");
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
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
