let formulario = document.getElementById("frmCliente");
let message = document.getElementById("message");

formulario.addEventListener("submit", async function(e){
    e.preventDefault();//Evitamos que se recargue la pagina

    console.log("dentro");
    let user = formulario.email.value;
    let pass = formulario.password.value;
    let obj = {};
    obj.usuario = user;
    obj.password = pass;
    obj.peticion = "login";
    console.log(obj.usuario)
    formulario.btnSubmitCli.setAttribute("value","cargando");
    const request = await fetch('http://localhost/DOLLARCITYMVC/acces/validarusuario',{
        method: 'POST',
        headres: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(obj)
    });

    const resp = await request.text();
    formulario.btnSubmitCli.setAttribute("value","Finalizado");
    if(resp === "correct"){
        message.innerText = "Inicio de sesion correcto";
        location.href="http://localhost/DOLLARCITYMVC/home";
    }else{
        message.innerText = "Credenciales incorrectas, vuelva a intentarlo";
    }
    console.log("La respuesta fue: "+ resp);
    
    
});


async function logout(){
    const request = await fetch('http://localhost/DOLLARCITYMVC/acces/logout',{
        method: 'GET',
        headres: {
            'Content-Type': 'application/json'
        }
    });

    const resp = await request.text();
    location.href = "http://localhost/DOLLARCITYMVC/home"
    
}



function mostrarOpciones(){
    document.getElementById("dvOpciones").removeAttribute('class');
    document.getElementById("frmCliente").setAttribute('class','ocultar');
    document.getElementById("frmEmpleado").setAttribute('class','ocultar');
}
function mostrarCliente(){
    document.getElementById("dvOpciones").setAttribute('class','ocultar');
    document.getElementById("frmCliente").removeAttribute('class');
    document.getElementById("frmEmpleado").setAttribute('class','ocultar');
}
function mostrarEmpleado(){
    document.getElementById("dvOpciones").setAttribute('class','ocultar');
    document.getElementById("frmCliente").setAttribute('class','ocultar');
    document.getElementById("frmEmpleado").removeAttribute('class');
}


