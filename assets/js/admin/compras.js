//asignar codigo de compra para eliminar
function setCodigoEliminar(id){
    document.getElementById("deleteCod").value = id;
  }



  function cargarTablaCompras(compras) {
    let filas = '';

    for (let compra of compras) {
        filas += '<tr id="tr' + compra.CodigoCompra + '">' +
            '<th>' + compra.CodigoCompra + '</th>' +
            '<td>' + compra.Empleado + '</td>' +
            '<td>' + compra.Proveedor + '</td>' +
            '<td>' + compra.Fecha + '</td>' +
            '<td>' + compra.Total + '</td>' +
            '<td>' +
            '<div style="display: flex;">' +
            '<i class="fas fa-tools"></i>' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div class="btn-group">' +
            '<button class="btn btn-outline-warning" type="button" data-toggle="modal" data-target="#staticBackdrop2">' +
            '<i class="fas fa-pen"></i>' +
            '</button>' +
            '<button class="btn btn-outline-danger" type="button" data-toggle="modal" data-target="#EliminarCompra" onclick="setCodigoEliminar(' + compra.CodigoCompra + ')">' +
            '<i class="fas fa-trash-alt"></i>' +
            '</button>' +
            '</div>' +
            '</td>' +
            '</tr>';
    }

    const compraTableBody = document.querySelector("#dataTable tbody");
    compraTableBody.innerHTML = filas;
}


  



async function registrarCompra() {
    const formularioCompra = document.getElementById("frmRegistrarCompra");

    let compra = {};
    compra.Empleado = formularioCompra.querySelector("#empleado").value;
    compra.Proveedor = formularioCompra.querySelector("#proveedor").value;
    compra.Fecha = formularioCompra.querySelector("#fecha").value;

    // Obtén los productos seleccionados
    const productosSeleccionados = formularioCompra.querySelectorAll(".productoCompra");
    const cantidadesSeleccionadas = formularioCompra.querySelectorAll(".cantidadCompra");

    compra.Productos = [];
    for (let i = 0; i < productosSeleccionados.length; i++) {
        compra.Productos.push({
            Producto: productosSeleccionados[i].value,
            Cantidad: cantidadesSeleccionadas[i].value
        });
    }

    compra.Subtotal = formularioCompra.querySelector("#subtotal").value;
    compra.Total = formularioCompra.querySelector("#total").value;

    const request = await fetch('http://localhost/DollarCity/admin/registrarcompra', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(compra)
    });

    const resp = await request.json();

    if (resp !== "error") {
        cargarTablaCompras(resp);
        
    } else {
        alert("Error al registrar la compra");
    }
}



async function modificarCompra() {
    const formularioModificarCompra = document.getElementById("frmModificarCompra");
    let compra = {};
    
    // Extract values from the form fields
    compra.CodigoCompra = formularioModificarCompra.codigo.value;
    compra.Empleado = formularioModificarCompra.empleado.value;
    compra.Proveedor = formularioModificarCompra.proveedor.value;
    compra.Fecha = formularioModificarCompra.fecha.value;

    // Collect selected products and quantities
    const productosSeleccionados = formularioModificarCompra.querySelectorAll(".productosSeleccionados .productoCompra");
    const cantidadesSeleccionadas = formularioModificarCompra.querySelectorAll(".productosSeleccionados .cantidadCompra");

    compra.Productos = [];
    for (let i = 0; i < productosSeleccionados.length; i++) {
        compra.Productos.push({
            Producto: productosSeleccionados[i].value,
            Cantidad: cantidadesSeleccionadas[i].value
        });
    }

   
    compra.Subtotal = formularioModificarCompra.subtotal.value;
    compra.Total = formularioModificarCompra.total.value;

    const request = await fetch('http://localhost/DollarCity/admin/modificarcompra', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(compra)
    });

    const resp = await request.json();

    if (resp !== "error") {
  
        cargarTablaCompras(resp);
       
    } else {
        alert("Error");
    }
}


async function eliminarCompra() {
    const codigoCompra = document.getElementById("deleteCod").value;

    const request = await fetch('http://localhost/DollarCity/admin/eliminarcompra', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ CodigoCompra: codigoCompra })
    });

    const resp = await request.json();

    if (resp !== "error") {
        cargarTablaCompras(resp);
    
    } else {
        alert("Error al eliminar la compra");
    }
}
