const formularioCliente = document.getElementById("frmCliente");
const formularioEmpleado = document.getElementById("frmEmpleado");
let message = document.getElementById("message");

formularioCliente.addEventListener("submit", async function(e){
    e.preventDefault();//Evitamos que se recargue la pagina
    let alerta = document.getElementById("mensajeCli");
    alerta.setAttribute("class","ocultar");
    
    let user = formularioCliente.email.value;
    let pass = formularioCliente.password.value;
    let obj = {};
    obj.usuario = user;
    obj.password = pass;
    formularioCliente.btnSubmitCli.setAttribute("disabled","disabled");
    formularioCliente.btnSubmitCli.setAttribute("value","Cargando");
    const request = await fetch('http://localhost/DOLLARCITY/acces/validarcliente',{
        method: 'POST',
        headres: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(obj)
    });

    const resp = await request.text();
    formularioCliente.btnSubmitCli.removeAttribute("disabled");
    formularioCliente.btnSubmitCli.setAttribute("value","Iniciar Sesion");
    if(resp === "correct"){
        alerta.innerText = "Inicio de sesion correcto";
        alerta.setAttribute("class","alert alert-success");
        location.href="http://localhost/DOLLARCITY/home";
    }else{
        
        alerta.innerText = "Credenciales incorrectas, vuelva a intentarlo";
        alerta.setAttribute("class","alert alert-danger");
    }
    console.log("La respuesta fue: "+ resp);
    
    
});

formularioEmpleado.addEventListener("submit", async function(e){
    e.preventDefault();//Evitamos que se recargue la pagina
    /*let alerta = document.getElementById("mensajeCli");
    alerta.setAttribute("class","ocultar");*/

    let obj = {};
    obj.usuario =  formularioEmpleado.usuario.value;
    obj.password = formularioEmpleado.password.value;
    /*formularioCliente.btnSubmitCli.setAttribute("disabled","disabled");
    formularioCliente.btnSubmitCli.setAttribute("value","Cargando");*/

    const request = await fetch('http://localhost/DOLLARCITY/acces/validarempleado',{
        method: 'POST',
        headres: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(obj)
    });

    const resp = await request.text();
    /*formulario.btnSubmitCli.removeAttribute("disabled");
    formulario.btnSubmitCli.setAttribute("value","Iniciar Sesion");*/
    if(resp === "correct"){
        /*alerta.innerText = "Inicio de sesion correcto";
        alerta.setAttribute("class","alert alert-success");*/
        location.href="http://localhost/DOLLARCITY/admin";
    }else{
        
        /*alerta.innerText = "Credenciales incorrectas, vuelva a intentarlo";
        alerta.setAttribute("class","alert alert-danger");*/
    }
    console.log("La respuesta fue: "+ resp);
    
    
});


async function logout(){
    const request = await fetch('http://localhost/DOLLARCITY/acces/logout',{
        method: 'GET',
        headres: {
            'Content-Type': 'application/json'
        }
    });

    const resp = await request.text();
    location.href = "http://localhost/DOLLARCITY/home"
    
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


