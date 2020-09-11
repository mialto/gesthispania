<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si'){
    echo "amos";
    var_dump($_SESSION);
    //
}else{
    header('Location: ../index.php');//=>va a la principal no a datos
}

?>