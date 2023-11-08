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