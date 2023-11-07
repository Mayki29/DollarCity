var attempt=3;
function validate() {
    var usuar=document.getElementById("ClienteUsuario").value;
    var password=document.getElementById("ClienteContraseña").value;
    if(usuar=="Cliente" && password=="12345"){
        alert("Ingreso Exitosamente");
        window.location= "InicioCliente.html";
        return false;
    }
    else{
        attempt--;
    }
    alert("Te queda "+attempt+" intentos mas")
    if(attempt==0){
        document.getElementById("ClienteUsuario").disable=true;
        document.getElementById("ClienteContraseña").disable=true;
        document.getElementById("submit").disable=true;

    }

}