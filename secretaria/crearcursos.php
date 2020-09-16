<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si' && $_SESSION['rol'] == 'admin'){
    include('../app/nodo.php');
    cabecera();
    menu();
    ?>
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-sm-12 mt-4">
                <h1>Crear Curso</h1>
            </div>
        </div>
        <form method="POST" action="crearcursos2">
            <div class="row">
                <div class="col-sm-6 mt-3">
                    <label for="curso">Curso</label>
                    <select class="form-control" id="curso" name="curso">
                        <option value="primero">Primero</option>
                        <option value="segundo">Segundo</option>
                        <option value="tercero">Tercero</option>
                        <option value="cuarto">Cuarto</option>
                        <option value="quinto">Quinto</option>
                        <option value="master doctorado">Master/Doctorado</option>
                    </select>
                </div>
                <div class="col-sm-6 mt-3">
                    <label for="titulacion">Titulación</label>
                    <select class="form-control" id="titulacion" name="titulacion" required>
                        <?php
                        optionsTitulaciones();
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mt-3">
                    <label for="duracion">Duración (meses 1-12)</label>
                    <input type="number" min="1" max="12" name="duracion" id="duracion" class="form-control" required>
                </div>
                <div class="col-sm-6 mt-3">
                    <label for="anno">Año academico</label>
                    <select class="form-control" id="anno" name="anno">
                        <?php 
                        $cont = date('Y')+5;
                        while ($cont >= 2018) { 
                            $cont2 = $cont+1;
                            ?>
                            <option value="<?php echo $cont . " - " .$cont2; ?>"><?php echo $cont . " - " .$cont2; ?></option>
                        <?php $cont = ($cont-1); } 
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
}else{
    header('Location: ../index.php');//=>va a la principal no a datos
}

?>