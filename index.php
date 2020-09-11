<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si'){
    header('Location: secretaria/datos.php');//=>va a la principal no a datos
}else{
    $_SESSION['logado'] = 'no';
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
                        <p>¿No tienes cuenta? <a href="secretaria/registro">Registrate aquí!</a></p>
                    </div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
    <?php
    pie();
}

?>