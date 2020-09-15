<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si'){
    $_SESSION['logado'] = 'no';
    $_SESSION['nombre'] = '';
    $_SESSION['apellidos'] = '';
    $_SESSION['email'] = '';
    $_SESSION['rol'] = '';
    $_SESSION['id'] = '';
    session_destroy();
    header('Location: ../index.php');
}else{
    header('Location: ../index.php');//=>va a la principal no a datos
}

?>