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
    compra.Empleado = formularioCompra.txtIdEmpleado.value;
    compra.Proveedor = formularioCompra.slcProveedor.value;
    compra.Fecha = formularioCompra.dtFecha.value;

    // Obtén los productos seleccionados
    const productosSeleccionados = formularioCompra.querySelectorAll(".productoCompraL");
    const cantidadesSeleccionadas = formularioCompra.querySelectorAll(".cantidadCompraL");

    compra.Productos = [];
    for (let i = 0; i < productosSeleccionados.length; i++) {
        compra.Productos.push({
            Producto: productosSeleccionados[i].value,
            Cantidad: cantidadesSeleccionadas[i].value
        });
    }

    //compra.Subtotal = formularioCompra.querySelector("#subtotal").value;
    //compra.Total = formularioCompra.querySelector("#total").value;

    const request = await fetch('http://localhost/DollarCity/admin/registrarcompra', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(compra)
    });

    const resp = await request.json();

    if (resp != "error") {
        location.href = 'http://localhost/DollarCity/admin/compras';
        //cargarTablaCompras(resp);
        
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

    if (resp != "error") {
        //cargarTablaCompras(resp);
        location.href = 'http://localhost/DollarCity/admin/compras';
    
    } else {
        alert("Error al eliminar la compra");
    }
}



function cargarTablaDetalleCompra(idCompra){

    let objCompra = [];
    for(let compra of dataDetalle){
        if (compra.CompraID === idCompra.toString()){
            objCompra = compra;
        }
    }
    
    let filas = '';
    for (let d of objCompra.DetalleCompra) {
        filas = filas + '<tr id="tr' + d.DetalleCompraID + '"><th>' + d.DetalleCompraID + '</th>' +
            '<td>' + d.Producto.Nombre+ '</td>' +
            '<td>' + d.Cantidad+ '</td>' +
            '<td>S/.<span>' + d.SubTotal + '<span></td></tr>'
    }

    document.getElementById("tbDetalleCompra").querySelector("tbody").innerHTML = filas;
}

async function cargarDataListProductos(){
    let producto = document.getElementById("txtProductosAgregar").value;
    let dataList = document.getElementById("dlOpcionesProductos");

    const request = await fetch('http://localhost/DollarCity/admin/buscarproducto/'+producto, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    });

    const respProductos = await request.json();
    let options = '';

    for(let p of respProductos){
        options += '<option value="'+p.Nombre+'"></option>'
    }

    dataList.innerHTML = options;
}

/*function buscarProductoPorIdLocal(id){
    let prod;
    for(let producto of dataProductos){
        if (compra.ProductoID === id.toString()){
            prod = producto;
            return prod;

        }
    }
    return null;
}*/