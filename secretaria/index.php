<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si'){
    include('../app/nodo.php');
    cabecera();
    menu();
    ?>
    <div class="container mt-5">
    <div class="separador50"></div>
        <div class="row mt-5">
            <div class="col-sm-12 mt-4">
                <h1>Listado de asignaturas</h1>
                <p>Mostradas por cursos años y titulaciones para saber el estado en el que se encuentran y si puede o no matricularse o desmatricularse.</p><br><hr><br>
                <?php mostrarCursosMatriculacion(); ?>
            </div>
        </div>
        <?php
        if($_SESSION['rol'] == 'admin'){
            ?>
            <div class="row mt-5">
                <div class="col-sm-12">
                    <a href="crearcursos" class="btn btn-info">Agregar cursos</a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    pie();
    //
}else{
    header('Location: ../index.php');//=>va a la principal no a datos
}

?>