function comparaPass(){
    var pas1 = document.getElementById('password').value;
    var pas2 = document.getElementById('repassword').value;
    if(pas1 != pas2){
        document.getElementById("errores").className = "alert alert-danger";
        document.getElementById('errores').innerHTML = 'La clave y su confirmación no coindiden';
        document.getElementById('enviar').disabled = true;
    }else if(pas1 === pas2){
        document.getElementById("errores").className = "alert alert-success";
        document.getElementById('errores').innerHTML = 'La clave y su confirmación son iguales';
        document.getElementById('enviar').disabled = false;
    }
}