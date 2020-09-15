<?php
session_start();
if(isset($_SESSION['logado']) && $_SESSION['logado']=='si'){
    header('Location: secretaria/');//=>va a la principal no a datos
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
                <?php
                    if(isset($_GET['error'])){
                        echo "<div class='alert alert-danger'>El usuario con la contraseña indicada no existe en el sistema</div>";
                    }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="login.php"> 
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                            <label for="pass">Contraseña</label>
                            <input type="password" id="pass" name="pass" class="form-control">
                            <input type="submit" value="enviar" class="btn btn-primary mt-3">
                        </form>
                        <p class="mt-3">¿No tienes cuenta? <a href="secretaria/registro">Registrate aquí!</a></p>
                    </div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
    <?php
    pie('index');
}

?>