<?php
/**
 * En este archivo se encuentran las funciones de template de la web para cargar el contenido
 */

 /** 
  * funcion que devuelvela cabecera de la web
  * args $vista => string con el tipo de vista, por defecto general
  */
function cabecera($vista='general'){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GestHispania</title>
        <!--Introducir el css-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
        <!--Introducir el javascript-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <!--css y js propios-->
        <?php
        if($vista == "index"){
            echo '<link rel="stylesheet" href="assets/css/css.css">';
            echo '<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
            ';
        }else{
            echo '<link rel="stylesheet" href="../assets/css/css.css">';
            echo '<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">';
            echo '<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">';
            echo '<script src="../assets/js/js.js"></script>';
            echo '<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>';
        }
        ?>
    </head>
    <body>
    <?php
}


/** 
  * funcion que devuelve el menu de la web
  * args $vista => string con el tipo de vista, por defecto general
  */
function menu($vista='general'){
    if ($vista == 'index'){
    ?>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <a href="#" class="navbar-brand"><img src="assets/img/gest.png" class="logo_cabecera"></a>
    </nav>
    <?php
    }else{
        if(isset($_SESSION['logado']) && $_SESSION['logado'] == 'si'){
        ?>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top ">
            <a href="#" class="navbar-brand"><img src="../assets/img/gest.png" class="logo_cabecera"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#colapsado">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="colapsado">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="titulaciones" class="nav-link">Titulaciones</a></li>   
                    <li class="nav-item"><a href="cursos" class="nav-link">Cursos</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Asignaturas</a></li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="navbardrop"><i class="fa fa-user" aria-hidden="true"></i> <?php echo " " . $_SESSION['nombre'];?></a>
                        <div class="dropdown-menu">
                            <a href="perfil" class="dropdown-item">Perfil</a>
                            <a href="modificarusuario" class="dropdown-item">Editar perfil</a>
                            <a href="cerrar.php" class="dropdown-item">Salir</a>
                        </div>
                    </li>
                </ul> 
            </div>    
        </nav>
    <?php
        }       
    }
    ?>
    <main class="mt-5">
    <?php
}

function pie($vista='general'){
    ?>
        </main>
        <footer class="bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <p>Desarrollado por: Miguel Ángel López Torralba<br><a href="mailto:miguel.a.torralba@gmail.com">miguel.a.torralba@gmail.com</a></p>
                    <?php
                    if($vista == 'index'){
                        echo '<a href="http://mialtoweb.es" target="_blank"><img src="assets/img/mialtoweblogo.png"></a>';
                    }else{
                        echo '<a href="http://mialtoweb.es" target="_blank"><img src="../assets/img/mialtoweblogo.png"></a>';
                    }
                    ?>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
        </footer>
    </body>
    </html>
    <?php
}
?>