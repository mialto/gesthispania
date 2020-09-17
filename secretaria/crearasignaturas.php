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
                <h1>Crear asignatura</h1>
            </div>
        </div>
        <form method="POST" action="crearasignaturas2">
            <div class="row">
                <div class="col-sm-6 mt-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>
                <div class="col-sm-6 mt-3">
                    <label for="creditos">Créditos </label>
                    <input type="number" min="0.5" max="22" step="0.5" name="creditos" id="duracion" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mt-3">
                    <label for="duracion">Duración</label>
                    <select class="form-control" id="duracion" name="duracion">
                        <option value="Cuatrimestral">Cuatrimestral</option>
                        <option value="Anual">Anual</option>
                    </select>
                </div>
                <div class="col-sm-6 mt-3">
                    <label for="curso">Curso</label>
                    <select class="selectpicker form-control" name="curso" data-show-subtext="true" id="curso" class="" data-live-search="true">
                        <?php
                        optionsCursos();
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mt-3">
                    <input type="submit" id="enviar" value="enviar" class="btn btn-primary float-right">
                </div>
            </div>  
        </form>
    </div>
    <?php
    pie();
    //
}else{
    header('Location: ../index.php');//=>va a la principal no a datos
}

?>