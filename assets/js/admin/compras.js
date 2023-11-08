//asignar codigo de empleado para eliminar
function setCodigoEliminar(id){
    document.getElementById("deleteCod").value = id;
  }

  
  async function eliminarCompra(){
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