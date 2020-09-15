<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si'){
    include('../app/nodo.php');
    cabecera();
    menu();
    ?>
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-sm-12 mt-4">
                illoo
            </div>
        </div>
    </div>
    <?php
    pie();
    //
}else{
    header('Location: ../index.php');//=>va a la principal no a datos
}

?>