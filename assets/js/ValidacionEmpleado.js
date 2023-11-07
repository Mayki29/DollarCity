var attempt=3;
function validate() {
    var usuar=document.getElementById("EmpleadoUsuario").value;
    var password=document.getElementById("EmpleadoContraseña").value;
    if(usuar=="Empleado1" && password=="123456"){
        alert("Ingreso Exitosamente");
        window.location= "InicioEmpleado.html";
        return false;
    }
    else{
        attempt--;
    }
    alert("Te queda "+attempt+" intentos mas")
    if(attempt==0){
        document.getElementById("EmpleadoUsuario").disable=true;
        document.getElementById("EmpleadoContraseña").disable=true;
        document.getElementById("submit").disable=true;

    }

}