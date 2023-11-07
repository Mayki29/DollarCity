document.addEventListener("DOMContentLoaded", function () {
    eventosModalRegistrar();
    eventosModalModificar();
    eventosModalEliminar();
});

//EVENTOS MODALES
//Modal Registrar
function eventosModalRegistrar(){
    const botonAgregar = document.getElementById("mostrarFormulario");
    const modal = document.getElementById("modal");
    const cerrarModal = document.getElementById("cerrarModal");

    botonAgregar.addEventListener("click", function () {
        modal.style.display = "block"; // Muestra la ventana modal al hacer clic en el botón
    });

    cerrarModal.addEventListener("click", function () {
        modal.style.display = "none"; // Cierra la ventana modal al hacer clic en la "X"
    });

    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none"; // Cierra la ventana modal si se hace clic fuera de ella
        }
    });
}
function cerrarModalRegistro() {
    document.getElementById("modal").style.display = "none";
    formularioRegistrar.reset();
}
//Modal Modificar
function eventosModalModificar(){
    const botonesModificar = document.querySelectorAll(".mostrarFormulario2");
    const modal = document.getElementById("modal2");
    const cerrarModal = document.getElementById("cerrarModal2");
    
    botonesModificar.forEach(boton => {
        boton.addEventListener("click", function () {
            modal.style.display = "block"; // Muestra la ventana modal al hacer clic en un botón
        });
    });
    
    cerrarModal.addEventListener("click", function () {
        modal.style.display = "none"; // Cierra la ventana modal al hacer clic en la "X"
    });
    
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none"; // Cierra la ventana modal si se hace clic fuera de ella
        }
    });
}
function cerrarModalModificar(){
    document.getElementById("modal2").style.display = "none";
}
//Modal eleminar
function eventosModalEliminar(){
    const eliminarButtons = document.querySelectorAll(".eliminar-button");
    const modal = document.getElementById("confirmarEliminarModal");
    const eliminarConfirmado = document.getElementById("eliminarConfirmado");
    const cancelarEliminacion = document.getElementById("cancelarEliminacion");
    let elementoAEliminarId = null;
  
    eliminarButtons.forEach(button => {
      button.addEventListener("click", function() {
        elementoAEliminarId = button.getAttribute("data-element-id");
        modal.style.display = "block";
      });
    });
  
    eliminarConfirmado.addEventListener("click", function() {
      if (elementoAEliminarId) {
        modal.style.display = "none";
      }
    });
  
    cancelarEliminacion.addEventListener("click", function() {
      modal.style.display = "none";
    });
}
function cerrarModalEliminar(){
    document.getElementById("confirmarEliminarModal").style.display = "none";
}


//FUNCIONES MODALES
//asignar codigo de empleado para eliminar
function setCodigoEliminar(id){
  document.getElementById("deleteCod").value = id;
}
//rellenar formulario con datos del empleado para modificar
function rellenarFormulario(id) {
    const celdas = document.getElementById("tr" + id).getElementsByTagName("td");

    document.getElementById("txtCodigoAE").value = id;
    document.getElementById("txtNombreAE").value = celdas[0].textContent;
    document.getElementById("txtApellidoAE").value = celdas[1].textContent;
    document.getElementById("txtEmailAE").value = celdas[2].textContent;
    document.getElementById("txtDniAE").value = celdas[3].textContent;
    document.getElementById("txtDireccionAE").value = celdas[4].textContent;
    document.getElementById("txtNumeroAE").value = celdas[5].textContent;
}


//CRUD
function cargarTablaEmpleados(empleados) {
    let filas = '';

    for (let e of empleados) {
        //console.log(e);
        filas = filas + '<tr id="tr' + e.usuarioId + '"><th>' + e.usuarioId + '</th>' +
            '<td>' + e.nombres + '</td>' +
            '<td>' + e.apellidos + '</td>' +
            '<td>' + e.email + '</td>' +
            '<td>' + e.dni + '</td>' +
            '<td>' + e.direccion + '</td>' +
            '<td>' + e.numeroTelefono + '</td>' +

            '<td><div class="btn-group">' +
            '<button class="btn btn-outline-warning mostrarFormulario2" type="button" onclick="rellenarFormulario(' + e.usuarioId + ')">' +
            '<i class="fas fa-user-cog"></i></button>' +
            '<button class="btn btn-outline-danger" type="button" onclick="setCodigoEliminar(' + e.usuarioId + ')">' +
            '<i class="fas fa-trash-alt eliminar-button"></i></button></div></td></tr>';
    }

    document.getElementById("dataTable").querySelector("tbody").innerHTML = filas;
    eventosModalModificar();
    eventosModalEliminar();
}
async function registrarEmpleado() {
    const formularioRegistrar = document.getElementById("frmResgistrarEmpleado");

    let compra = {
        Empleado:'asfasgs',
        Proveedor:'a',
        detalle : {
            producto :asf
        },
        fecha :'asfasf'};
    let detalle = {};

    compra.detalle = detalle


    let empleado = {};
    empleado.nombres = formularioRegistrar.nombre.value;
    empleado.apellidos = formularioRegistrar.apellido.value;
    empleado.email = formularioRegistrar.email.value;
    empleado.dni = formularioRegistrar.dni.value;
    empleado.direccion = formularioRegistrar.direccion.value;
    empleado.numeroTelefono = formularioRegistrar.numero.value;

    const request = await fetch('http://localhost/DOLLARCITYMVC/admin/registrarempleado', {
        method: 'POST',
        headres: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(empleado)
    });

    const resp = await request.json();

    if (resp != "error") {
        cargarTablaEmpleados(resp);
        cerrarModalRegistro();

    } else {
        alert("Error");
    }
}
async function modificarEmpleado() {
    const formularioModificar = document.getElementById("frmModificarEmpleado")
    let empleado = {};
    empleado.usuarioId = formularioModificar.codigo.value;
    empleado.nombres = formularioModificar.nombre.value;
    empleado.apellidos = formularioModificar.apellido.value;
    empleado.email = formularioModificar.email.value;
    empleado.dni = formularioModificar.dni.value;
    empleado.direccion = formularioModificar.direccion.value;
    empleado.numeroTelefono = formularioModificar.numero.value;

    const request = await fetch('http://localhost/DOLLARCITYMVC/admin/modificarempleado', {
        method: 'POST',
        headres: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(empleado)
    });

    const resp = await request.json();

    if (resp != "error") {
        cargarTablaEmpleados(resp);
        cerrarModalModificar();

    } else {
        alert("Error");
    }
}
async function eliminarEmpleado(){
    const formularioEliminar = document.getElementById("frmEliminarEmpleado")
    let empleado = {};
    empleado.usuarioId = formularioEliminar.codigo.value;

    const request = await fetch('http://localhost/DOLLARCITYMVC/admin/eliminarempleado', {
        method: 'POST',
        headres: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(empleado)
    });

    const resp = await request.json();

    if (resp != "error") {
        cargarTablaEmpleados(resp);
        cerrarModalEliminar();

    } else {
        alert("Error");
    }
}