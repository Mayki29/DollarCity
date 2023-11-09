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
    const botonesModificar = document.querySelectorAll(".mostrarFormulario4");
    const modal = document.getElementById("modal4");
    const cerrarModal = document.getElementById("cerrarModal4");

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
    document.getElementById("modal4").style.display = "none";
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

    document.getElementById("txtCodigoAc").value = id;
    document.getElementById("txtNombreProductoAc").value = celdas[0].textContent;
    document.getElementById("txaDescripcionAc").value = celdas[1].textContent;
    document.getElementById("txtPrecioAc").value = celdas[2].getElementsByTagName("span")[0].textContent;
    document.getElementById("txtStockAc").value = celdas[3].textContent;
    let optionsCat = document.getElementById("slCategoriaAc");
    for (let i = 0; i < optionsCat.length; i++) {
        if(optionsCat[i].textContent.trim() == celdas[4].textContent.trim()){
            optionsCat[i].setAttribute("selected","selected");
        }else{
            optionsCat[i].removeAttribute("selected","selected");
        }
    }
}


//CRUD
function cargarTablaProductos(productos) {
    let filas = '';

    for (let p of productos) {
        //console.log(e);
        filas = filas + '<tr id="tr' + p.ProductoID + '"><th>' + p.ProductoID + '</th>' +
            '<td>' + p.Nombre + '</td>' +
            '<td>' + p.Descripcion + '</td>' +
            '<td>S/.<span>' + p.Precio + '<span></td>' +
            '<td>' + p.CantidadEnStock + '</td>' +
            '<td>' + p.Categoria.Nombre + '</td>' +

            '<td><div class="btn-group">' +
            '<button class="btn btn-outline-warning mostrarFormulario4" type="button" onclick="rellenarFormulario(' + p.ProductoID + ')">' +
            '<i class="fas fa-user-cog"></i></button>' +
            '<button class="btn btn-outline-danger" type="button" onclick="setCodigoEliminar(' + p.ProductoID + ')">' +
            '<i class="fas fa-trash-alt eliminar-button"></i></button></div></td></tr>';
    }

    document.getElementById("dataTable").querySelector("tbody").innerHTML = filas;
    eventosModalModificar();
    eventosModalEliminar();
}



async function registrarProducto() {
    const formularioRegistrar = document.getElementById("frmResgistrarProducto");

    let producto = {};
    producto.Nombre = formularioRegistrar.nombre.value;
    producto.Descripcion = formularioRegistrar.descripcion.value;
    producto.Precio = formularioRegistrar.precio.value;
    producto.CantidadEnStock = formularioRegistrar.stock.value;
    producto.CategoriaID = formularioRegistrar.categoria.value;


    const request = await fetch('http://localhost/DollarCity/admin/registrarproducto', {
        method: 'POST',
        headres: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(producto)
    });

    const resp = await request.json();

    if (resp != "error") {
        cargarTablaProductos(resp.Productos);
        actualizarDatos(resp.Grafico);
        cerrarModalRegistro();

    } else {
        alert("Error");
    }
}



async function modificarProducto() {
    const formularioModificar = document.getElementById("frmModificarProducto")
    let producto = {};
    producto.ProductoID = formularioModificar.codigo.value;
    producto.Nombre = formularioModificar.nombre.value;
    producto.Descripcion = formularioModificar.descripcion.value;
    producto.Precio = formularioModificar.precio.value;
    producto.CantidadEnStock = formularioModificar.stock.value;
    producto.CategoriaID = formularioModificar.categoria.value;

    const request = await fetch('http://localhost/DollarCity/admin/modificarproducto', {
        method: 'POST',
        headres: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(producto)
    });

    const resp = await request.json();

    if (resp != "error") {
        cargarTablaProductos(resp.Productos);
        actualizarDatos(resp.Grafico);
        cerrarModalModificar();

    } else {
        alert("Error");
    }
}


async function eliminarProducto(){
    const formularioEliminar = document.getElementById("frmEliminarProducto")
    let producto = {};
    producto.ProductoID = formularioEliminar.deleteCod.value;

    const request = await fetch('http://localhost/DollarCity/admin/eliminarproducto', {
        method: 'POST',
        headres: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(producto)
    });

    const resp = await request.json();

    if (resp != "error") {
        cargarTablaProductos(resp.Productos);
        actualizarDatos(resp.Grafico);
        cerrarModalEliminar();

    } else {
        alert("Error");
    }
}