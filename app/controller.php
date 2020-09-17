<?php
/** 
 * limpia los datos para evitar la inyeccion de codigo
 * args $data => recibe el campo para limpiar
 * return => el campo limpio
 */
function limpiarCampos($data){
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

/**
 * Muestra los datos del usuario que esta logueado
 * args $id => la id del usuario logueado 
 */
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

/**
 * pinta los cursos ordenados
 */
function mostrarCursos(){
    $mysqli = conexion();
    $sentencia = "SELECT * FROM cursos ORDER BY titulacion DESC, anno_academico DESC ";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    ?>
    <table id="myTable" class="display dataTable no-footer" style="width:100%" role="grid" aria-describedby="example_info">
        <thead>
            <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 113.717px;" aria-sort="ascending" aria-label="">Curso</th>
                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 109.633px;" aria-label="">Titulación</th>
                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 252.517px;" aria-label="">Duración</th>
                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 115.067px;" aria-label="">Año académico</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $contador = 1;
    while($fila = $resultado->fetch_array()) {
        if($contador%2 == 0){
            echo '<tr role="row" class="odd">';
        }else{
            echo '<tr role="row" class="even">';
        }
        ?>
            <td class="sorting_1 sorting_2"><?php echo $fila['curso']?></td>
            <td><?php echo $fila['titulacion']?></td>
            <td><?php echo $fila['duracion']?></td>
            <td><?php echo $fila['anno_academico']?></td>
        </tr>
        <?php
        $contador++;
    }
    ?>
        </tbody>
	</table>
    <?php
    $resultado->close();
    $mysqli->close();
}

/**
 * pinta las asignaturas
 */
function mostrarAsignaturas(){
    $mysqli = conexion();
    $sentencia = "SELECT asignaturas.*, cursos.curso, cursos.titulacion, cursos.anno_academico FROM `asignaturas` INNER JOIN cursos ON asignaturas.curso=cursos.id ORDER BY asignaturas.nombre DESC ";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    ?>
    <table id="myTable" class="display dataTable no-footer" style="width:100%" role="grid" aria-describedby="example_info">
        <thead>
            <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 113.717px;" aria-sort="ascending" aria-label="">Nombre</th>
                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 109.633px;" aria-label="">Créditos</th>
                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 252.517px;" aria-label="">Duracion</th>
                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 115.067px;" aria-label="">Curso</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $contador = 1;
    while($fila = $resultado->fetch_array()) {
        if($contador%2 == 0){
            echo '<tr role="row" class="odd">';
        }else{
            echo '<tr role="row" class="even">';
        }
        ?>
            <td class="sorting_1 sorting_2"><?php echo $fila['nombre']?></td>
            <td><?php echo $fila['creditos']; ?></td>
            <td><?php echo $fila['duracion']?></td>
            <td><?php echo $fila['curso'] . " " . $fila['titulacion'] . " " . $fila['anno_academico'];?></td>
        </tr>
        <?php
        $contador++;
    }
    ?>
        </tbody>
	</table>
    <?php
    $resultado->close();
    $mysqli->close();
}

/**
 * pinta las titulaciones ordenadas por nombre
 */
function mostrarTitulaciones(){
    $mysqli = conexion();
    $sentencia = "SELECT * FROM titulaciones ORDER BY titulacion ASC";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    ?>
    <ul>
    <?php
    while($fila = $resultado->fetch_array()) {
        ?>
        <li><?php echo $fila['titulacion']?></li>
        <?php
    }
    $resultado->close();
    $mysqli->close();
}

/**
 * crea los options de las titualciones para crear los cursos
 * nota: al haber creado las titulaciones como entidad despues de haberlas programado como campo que es lo que
 * requerian las especificaciones, en lugar de la id para crear un FK he guardado el nombre del campo para que
 * la programción fuera más rápida
 */
function optionsTitulaciones(){
    $mysqli = conexion();
    $sentencia = "SELECT * FROM titulaciones ORDER BY titulacion ASC";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    ?>
    <?php
    while($fila = $resultado->fetch_array()) {
        ?>
        <option value="<?php echo $fila['titulacion'];?>"><?php echo $fila['titulacion'];?></option>
        <?php
    }
    $resultado->close();
    $mysqli->close();
}

/**
 * crea las opciones de los cursos por cursos y titulaciones
 */
function optionsCursos(){
    $mysqli = conexion();
    $sentencia = "SELECT * FROM cursos ORDER BY titulacion ASC, anno_academico ASC";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    ?>
    <?php
    while($fila = $resultado->fetch_array()) {
        ?>
        <option value="<?php echo $fila['id'];?>"><?php echo $fila['curso'] . " " . $fila['titulacion'] . " " . $fila['anno_academico'];?></option>
        <?php
    }
    $resultado->close();
    $mysqli->close();
}
?>