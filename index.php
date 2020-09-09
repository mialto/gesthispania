<?php
session_start();
if(!isset($_SESSION['logado'])){
    include('template/template.php');
    cabecera('index');
    menu('index');
    ?>
    <div class="container">
        <div class="row login">
            <div class="col-4"></div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        aqui el formulario!!!
                        <p>¿No tienes cuenta? <a href="views/registro">Registrate aquí!</a></p>
                    </div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
    <?php
    pie();
}else{
    header('Location: views/datos.php');
}

?>