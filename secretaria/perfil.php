<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si'){
    include('../app/nodo.php');
    cabecera();
    menu();
    ?>
    <div class="container mt-5">
        <div class="separador50"></div>
        <div class="separador50"></div>
        <div class="row">
            <div class="col-12">
                <h1>Perfil</h1>
            </div>
        </div>
        <div class="separador50"></div>
        <?php mostrarDatos($_SESSION['id']); ?>
        <div class="separador50"></div>
        <div class="row">
            <div class="col-12">
            <a href="modificarusuario" class="btn btn-info">Modificar datos</a>
            </div>
        </div>
    </div>
    <?php
    pie();
}else{
    header('Location: ../index.php');//=>va a la principal no a datos
}

?>