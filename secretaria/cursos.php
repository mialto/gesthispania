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
                <h1>Cursos</h1>
                <?php mostrarCursos();?>

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
    <script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    </script>
    <?php
    pie();
    //
}else{
    header('Location: ../index.php');//=>va a la principal no a datos
}

?>