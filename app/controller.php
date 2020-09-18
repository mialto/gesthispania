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
                <?php
                if($_SESSION['rol'] == 'admin'){
                    echo '<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 115.067px;" aria-label="">Acciones</th>';
                }
                ?>         
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
            <?php
                if($_SESSION['rol'] == 'admin'){
                    echo '<td><a href="modificarasignaturas?id_curso=' . $fila['id'] . '" class="btn btn-warning btn-sm">Asignaturas</a></td>';
                }
                ?>    
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
    $sentencia = "SELECT asignaturas.*, cursos.curso, cursos.titulacion, cursos.anno_academico FROM `asignaturas` INNER JOIN cursos ON asignaturas.curso=cursos.id WHERE asignaturas.activa=1 ORDER BY asignaturas.nombre DESC ";
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

/**
 * pinta el listado de asigntura para modificar la asignacion de asignaturas
 * args $id => id del curso para modificar las asignaturas
 */
function modificarAsignaturas($id){
    $mysqli = conexion();
    $sentencia = "SELECT asignaturas.*, cursos.curso, cursos.titulacion, cursos.anno_academico FROM `asignaturas` INNER JOIN cursos ON asignaturas.curso=cursos.id WHERE asignaturas.curso=" . $id . " AND asignaturas.activa=1 ORDER BY asignaturas.nombre DESC ";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    ?>
    <table id="myTable" class="display dataTable no-footer" style="width:100%" role="grid" aria-describedby="example_info">
        <thead>
            <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 113.717px;" aria-sort="ascending" aria-label="">Nombre</th>
                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 40.633px;" aria-label="">Créditos</th>
                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 50.517px;" aria-label="">Duracion</th>
                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 115.067px;" aria-label="">Curso asignado</th>
                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 115.067px;" aria-label="">Acciones</th>
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
            <td>
                <?php
                        echo '<span class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar_' . $fila['id'] . '" >Eliminar</span>';
                ?>
            </td>
        </tr>
        <!--modal-->
        <div class="modal fade" id="eliminar_<?php echo $fila['id'];?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--header-->
                    <div class="modal-header">
                        <h4 class="modal-title">Eliminar asignatura <?php echo $fila['nombre'];?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!--body-->
                    <div class="modal-body">
                        <p>¿Esta seguro que quiere eliminar la asignatura <br>
                        <b><?php echo $fila['nombre'];?></b> del curso <br>
                        <b><?php echo $fila['curso'] . " " . $fila['titulacion'] . " " . $fila['anno_academico'];?></b>?</p>
                        <center><a href="eliminarasignatura?id_asignatura=<?php echo $fila['id'];?>&id_curso=<?php echo $id ?>" class="btn btn-success btn-sm">Aceptar</a> <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button></center>
                        <small>Esta acción dejará la asignatura para su libre asignacion a otro curso</small>
                    </div>
                    <!--footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar modal</button>
                    </div>
                </div>
            </div>
        </div>
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
 * muestra una tabla con las asignaturas sin asignar
 */
function asignaturasSinAsignar($id){
    $mysqli = conexion();
    $sentencia = "SELECT * FROM `asignaturas` WHERE activa=0 ORDER BY nombre DESC ";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    ?>
    <table id="sinAsignar" class="display dataTable no-footer" style="width:100%" role="grid" aria-describedby="example_info">
        <thead>
            <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 113.717px;" aria-sort="ascending" aria-label="">Nombre</th>
                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 40.633px;" aria-label="">Créditos</th>
                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 50.517px;" aria-label="">Duracion</th>
                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 115.067px;" aria-label="">Acciones</th>
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
            <td>
                <?php
                        echo '<span class="btn btn-success btn-sm" data-toggle="modal" data-target="#asignar_' . $fila['id'] . '" >Asignar</span>';
                ?>
            </td>
        </tr>
        <!--modal-->
        <div class="modal fade" id="asignar_<?php echo $fila['id'];?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--header-->
                    <div class="modal-header">
                        <h4 class="modal-title">Asignar asignatura <?php echo $fila['nombre'];?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!--body-->
                    <div class="modal-body">
                        <p>¿Esta seguro que quiere eliminar la asignatura <br>
                        <b><?php echo $fila['nombre'];?></b> al curso?</p>
                        <center><a href="asignarasignatura?id_asignatura=<?php echo $fila['id'];?>&id_curso=<?php echo $id ?>" class="btn btn-success btn-sm">Aceptar</a> <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button></center>
                        
                    </div>
                    <!--footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar modal</button>
                    </div>
                </div>
            </div>
        </div>
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
?>