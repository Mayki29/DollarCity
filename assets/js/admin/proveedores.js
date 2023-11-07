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
  
    botonAgregar.addEventListener("click", function() {
      modal.style.display = "block"; // Muestra la ventana modal al hacer clic en el botón
    });
  
    cerrarModal.addEventListener("click", function() {
      modal.style.display = "none"; // Cierra la ventana modal al hacer clic en la "X"
    });
  
    window.addEventListener("click", function(event) {
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
    const botonesModificar = document.querySelectorAll(".mostrarFormulario3");
    const modal = document.getElementById("modal3");
    const cerrarModal = document.getElementById("cerrarModal3");

    botonesModificar.forEach(boton => {
        boton.addEventListener("click", function() {
            modal.style.display = "block"; // Muestra la ventana modal al hacer clic en un botón
        });
    });

    cerrarModal.addEventListener("click", function() {
        modal.style.display = "none"; // Cierra la ventana modal al hacer clic en la "X"
    });

    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none"; // Cierra la ventana modal si se hace clic fuera de ella
        }
    });
}
function cerrarModalModificar(){
    document.getElementById("modal3").style.display = "none";
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
    const celdas= document.getElementById("tr" + id).getElementsByTagName("td");

    document.getElementById("txtCodigoAP").value = id;
    document.getElementById("txtRazonSocialAP").value = celdas[0].textContent;
    document.getElementById("txtRucAP").value = celdas[1].textContent;
    document.getElementById("txtDireccionAP").value = celdas[2].textContent;
    document.getElementById("txtNumeroAP").value = celdas[3].textContent;
    document.getElementById("txtEmailAP").value = celdas[4].textContent;
}


//CRUD
function cargarTablaProveedores(proveedores) {
    let filas = '';

    for (let p of proveedores) {
        //console.log(e);
        filas = filas + '<tr id="tr' + p.ProveedorID + '"><th>' + p.ProveedorID + '</th>' +
            '<td>' + p.RazonSocial + '</td>' +
            '<td>' + p.RUC + '</td>' +
            '<td>' + p.Direccion + '</td>' +
            '<td>' + p.Telefono + '</td>' +
            '<td>' + p.Email + '</td>' +

            '<td><div class="btn-group">' +
            '<button class="btn btn-outline-warning mostrarFormulario3" type="button" onclick="rellenarFormulario(' + p.ProveedorID + ')">' +
            '<i class="fas fa-user-cog"></i></button>' +
            '<button class="btn btn-outline-danger" type="button" onclick="setCodigoEliminar(' + p.ProveedorID + ')">' +
            '<i class="fas fa-trash-alt eliminar-button"></i></button></div></td></tr>';
    }

    document.getElementById("dataTable").querySelector("tbody").innerHTML = filas;
    eventosModalModificar();
    eventosModalEliminar();
}
async function registrarProveedor() {
    const formularioRegistrar = document.getElementById("frmResgistrarProveedor");

    let proveedor = {};
    proveedor.RazonSocial = formularioRegistrar.razonSocial.value;
    proveedor.RUC = formularioRegistrar.ruc.value;
    proveedor.Direccion = formularioRegistrar.direccion.value;
    proveedor.Telefono = formularioRegistrar.numero.value;
    proveedor.Email = formularioRegistrar.email.value;

    const request = await fetch('http://localhost/DOLLARCITYMVC/admin/registrarproveedor', {
        method: 'POST',
        headres: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(proveedor)
    });

    const resp = await request.json();

    if (resp != "error") {
        cargarTablaProveedores(resp);
        cerrarModalRegistro();

    } else {
        alert("Error");
    }
}
async function modificarProveedor() {
    const formularioModificar = document.getElementById("frmModificarProveedor")
    let proveedor = {};
    proveedor.ProveedorID = formularioModificar.codigo.value;
    proveedor.RazonSocial = formularioModificar.razonSocial.value;
    proveedor.RUC = formularioModificar.ruc.value;
    proveedor.Direccion = formularioModificar.direccion.value;
    proveedor.Telefono = formularioModificar.numero.value;
    proveedor.Email = formularioModificar.email.value;

    const request = await fetch('http://localhost/DOLLARCITYMVC/admin/modificarproveedor', {
        method: 'POST',
        headres: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(proveedor)
    });

    const resp = await request.json();

    if (resp != "error") {
        cargarTablaProveedores(resp);
        cerrarModalModificar();

    } else {
        alert("Error");
    }
}
async function eliminarProveedor(){
    const formularioEliminar = document.getElementById("frmEliminarProveedor")
    let proveedor = {};
    proveedor.ProveedorID = formularioEliminar.deleteCod.value;

    const request = await fetch('http://localhost/DOLLARCITYMVC/admin/eliminarproveedor', {
        method: 'POST',
        headres: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(proveedor)
    });

    const resp = await request.json();

    if (resp != "error") {
        cargarTablaProveedores(resp);
        cerrarModalEliminar();

    } else {
        alert("Error");
    }
}