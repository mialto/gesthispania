<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si' && $_SESSION['rol'] == 'admin'){
    include('../app/nodo.php');
    cabecera();
    menu();
    ?>
    <div class="container mt-5">
    <div class="separador50"></div>
        <div class="row mt-5">
            <div class="col-sm-12 mt-4">
                <h1>Crear Titulación</h1>
            </div>
        </div>
        <form method="POST" action="creartitulaciones2">
            <div class="row">
                <div class="col-sm-6 mt-3">
                    <label for="titulacion">Titulación</label>
                    <input type="text" name="titulacion" id="titulacion" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mt-3">
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