<?php
/** 
 * limpia los datos para evitar la inyeccion de codigo
 * 
 */
function limpiarCampos($data){
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

function mostrarDatos($id){
    $mysqli = conexion();
    $sentencia = "SELECT * FROM usuarios WHERE id='$id'";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    while($fila = $resultado->fetch_array()) {
        ?>
        <div class="row">
            <div class="col-sm-6">
                <p class="mostrar_datos"><span class="campo_en_linea">Nombre:</span> <?php echo $fila['nombre']; ?> </p>
            </div>
            <div class="col-sm-6">
                <p class="mostrar_datos"><span class="campo_en_linea">Apellidos:</span> <?php echo $fila['apellidos']; ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p class="mostrar_datos"><span class="campo_en_linea">Mail:</span> <?php echo $fila['email']; ?> </p>
            </div>
            <div class="col-sm-6">
                <p class="mostrar_datos"><span class="campo_en_linea">Rol:</span> <?php echo $fila['rol']; ?> </p>
            </div>
        </div>
        <?php
    }
    $resultado->close();
    $mysqli->close();
}
?>