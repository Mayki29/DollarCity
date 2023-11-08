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

  
  /*async function eliminarCompra(){
    const formularioEliminar = document.getElementById("frmEliminarCompra")
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
        cargarTablaProductos(resp);
        cerrarModalEliminar();

    } else {
        alert("Error");
    }
}

*/
async function registrarCompra() {
    const formularioCompra = document.getElementById("frmRegistrarCompra");

    let compra = {};
    compra.Empleado = formularioCompra.querySelector("#disabledTextInput").value;
    compra.Proveedor = formularioCompra.querySelector("#inputGroupSelect01").value;
    compra.Fecha = formularioCompra.querySelector("#apellido").value;
    
 
    const productosSeleccionados = formularioCompra.querySelectorAll(".productosSeleccionados .producto");
    const cantidadesSeleccionadas = formularioCompra.querySelectorAll(".productosSeleccionados .cantidad");
    
    compra.Productos = [];
    for (let i = 0; i < productosSeleccionados.length; i++) {
        compra.Productos.push({
            Producto: productosSeleccionados[i].textContent,
            Cantidad: cantidadesSeleccionadas[i].textContent
        });
    }

    const subtotal = formularioCompra.querySelector("#subtotal").value;
    const total = formularioCompra.querySelector("#disabledTextInput").value;

    compra.Subtotal = subtotal;
    compra.Total = total;

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
        alert("Error");
    }
}
