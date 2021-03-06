<?php
session_start();
if($_SESSION['logado'] == 'no'){
    include('../app/nodo.php');
    cabecera();
    menu();
    ?>
    <div class="container mt-4">
        <div class="row mt-4">
            <div class="col-sm-12 mt-4">
                <h1>Formulario de Registro</h1>
                <div id="errores" class=""></div>
            </div>  
        </div>
        <form method="POST"  action="registro2">
            <div class="row">
                <div class="col-sm-6 mt-3">
                    <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" pattern="[a-záéíóúA-ZÁÉÍÓÚ ]+" required>
                </div>
                <div class="col-sm-6 mt-3">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control" patern="[a-záéíóúA-ZÁÉÍÓÚ ]+" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mt-3">
                    <label for="email">email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>    
            </div>
            <div class="row">
                <div class="col-sm-6 mt-3">
                    <label for="password">Contraseña <br><small>Requiere mayúscula, minúscula, numero, carácter especial y minimo 8 digitos</small></label>
                    <input type="password" name="password" id="password" class="form-control" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" onchange="comparaPass()" required>
                </div>
                <div class="col-sm-6 mt-3">
                    <label for="repasswrod">Repite tu contraseña <br><small>Requiere mayúscula, minúscula, numero, carácter especial y minimo 8 digitos</small></label>
                    <input type="password" name="repassword" id="repassword" class="form-control" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" onchange="comparaPass()" required>
                </div>  
            </div>
            <div class="row">
                <div class="col-sm-12 mt-3">
                    <input type="submit" id="enviar" value="enviar" class="btn btn-primary float-right" disabled>
                </div>
            </div>  
           
            
        </form>
    <?php
    pie();
}else{
    //envia a la pagina principal!
}

?>
