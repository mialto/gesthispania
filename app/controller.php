<?php
/** 
 * 
 */
function limpiarCampos($data){
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}
?>