document.addEventListener('DOMContentLoaded', function() {
    cargaTablaContactos();

    document.getElementById('btnAgregarContacto').addEventListener('click', function() {
        var nombre = document.getElementById('nombre').value;

        if (nombre === "") {
            alert("Debes agregar el nombre");
            return false;
        }

        agregarContacto();
    });

    document.getElementById('btnActualizarContacto').addEventListener('click', function() {
        actualizarContacto();
    });
});

function cargaTablaContactos() {
    fetch('vistas/contactos/tablaContactos.php')
        .then(response => response.text())
        .then(html => {
            document.getElementById('cargaTablaContactos').innerHTML = html;
        })
        .catch(error => console.error('Error loading the table: ', error));
}

function agregarContacto() {
    var formData = new FormData(document.getElementById('frmAgregarContacto'));

    fetch('procesos/contactos/agregarContacto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(response => {
        if (response.trim() === "1") {
            document.getElementById('frmAgregarContacto').reset();
            cargaTablaContactos();
            alert("Se agregó con éxito!");
        } else {
            
            alert("No se pudo agregar!");
        }
    })
    .catch(error => console.error('Error adding contact: ', error));
}

function actualizarContacto() {
    var formData = new FormData(document.getElementById('frmAgregarContactoU'));

    fetch('procesos/contactos/actualizarContacto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(response => {
        if (response.trim() === "1") {
            cargaTablaContactos();
            alert("Se actualizó con éxito!");
        } else {
            alert("No se pudo actualizar!");
        }
    })
    .catch(error => console.error('Error updating contact: ', error));
}

function eliminarContacto(idContacto) {
    if (confirm("¿Está seguro de eliminar este contacto? Una vez eliminado no podrá ser recuperado!")) {
        fetch('procesos/contactos/eliminarContacto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'idContacto=' + idContacto
        })
        .then(response => response.text())
        .then(response => {
            if (response.trim() === "1") {
                cargaTablaContactos();
                alert("Se eliminó con éxito!");
            } else {
                alert("No se pudo eliminar!");
            }
        })
        .catch(error => console.error('Error deleting contact: ', error));
    }
}

function obtenerDatosContacto(idContacto) {
    fetch('procesos/contactos/obtenerDatosContacto.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'idContacto=' + idContacto
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('nombreU').value = data.nombre;
        document.getElementById('apaternoU').value = data.paterno;
        document.getElementById('amaternoU').value = data.materno;
        document.getElementById('telefonoU').value = data.telefono;
        document.getElementById('emailU').value = data.email;
        document.getElementById('idContactoU').value = data.id_contacto;
    })
    .catch(error => console.error('Error fetching contact data: ', error));
}

