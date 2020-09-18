<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si' && $_SESSION['rol'] == 'admin'){
    $id_curso = $_GET['id_curso'];
    include('../app/nodo.php');
    cabecera();
    menu();
    ?>
    <div class="container mt-5">
        <div class="separador50"></div>
        <div class="row mt-5">
            <div class="col-sm-12 mt-4">
                <h1>Modificar asignaturas</h1>
                <h2 class="mb-4">Asignaturas del curso</h2>
                <?php 
                modificarAsignaturas($id_curso);
                ?>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12 mt-4">
                <h2 class="mb-4">Asignaturas sin asignar</h2>
                <?php 
                asignaturasSinAsignar($id_curso);
                ?>
            </div>
        </div>
        <?php
        if($_SESSION['rol'] == 'admin'){
            ?>
            <div class="row mt-5">
                <div class="col-sm-12">
                    <a href="crearasignaturas" class="btn btn-info">Agregar Asignaturas al sistema</a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <script>
    $(document).ready( function () {
        $('#myTable').DataTable();
        $('#sinAsignar').DataTable();
    } );
    </script>
    <?php
    pie();
}else{
    header('Location: ../index.php');//=>va a la principal no a datos
}

?>