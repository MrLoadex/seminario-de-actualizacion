<!DOCTYPE html>
<html lang="es">
<head>
    <title>Contactos agenda</title>
    <link rel="icon" type="image/jpg" href="public/img/favicon.jpg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    /* Estilos del Modal */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
        border-radius: 5px;
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #007bff;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 20px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            padding: 10px 20px;
        }
        .navbar a:hover {
            background-color: #0056b3;
            border-radius: 5px;
        }
        .container {
            width: 95%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f1f1f1;
            border-radius: 5px;
        }
        .button, .btn-secondary {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover, .btn-secondary:hover {
            background-color: #0056b3;
        }
        .contact-list {
            margin: 10px 0;
        }
        .contact {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        .contact:last-child {
            border-bottom: none;
        }
        .hidden {
            display: none;
        }
        form {
            margin: 20px 0;
        }
		
		.disabled-checkbox {
        pointer-events: none;
        opacity: 0.4;
        /* Mejora en el tipo de letra y color general */
        body, html {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Estilo de tarjetas para los contactos */
        .contact {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 10px;
            border-radius: 8px;
            overflow: hidden;
        }

        /* Mejoras en el modal */
        .modal-content {
            box-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }

        /* Estilo de botones más moderno */
        .button, .btn-secondary {
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        /* Navbar mejorado */
        .navbar {
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

    }

</style>
</head>
<body>
	<nav class="navbar">
			<a href="index.php">Inicio</a>
			<a href="contactos.php">Contactos</a>
	</nav>
	<div class="container">
        <button class="button" onclick="openCreateModal()">Crear contacto</button>
		<button class="button" onclick="openModifyModal()">Modificar contacto</button>
		<button class="button" onclick="deleteSelectedContact()">Eliminar contacto</button>
        
		<div id="cargaTablaContactos" class="contact-list">
            <!-- Los contactos se listarán aquí -->
		</div>
		<button class="button" id="btnCargaTablaContactos" onclick="cargaTablaContactos()">Actualizar</button>
        <?php require_once "vistas/contactos/modalActualizar.php"; ?> 
	</div>
    
    <?php require_once "vistas/contactos/modalAgregar.php"; ?>
    
	<script src="public/js/contactos.js"></script>

	<script>

		// JavaScript adicional para manejar selección única de checkbox y botones
        function handleCheckboxClick(clickedCheckbox) {
            var checkboxes = document.querySelectorAll('.contact-checkbox');
            checkboxes.forEach(cb => {
                if (cb !== clickedCheckbox) {
                    cb.checked = false;
                    cb.parentNode.classList.remove('disabled-checkbox');
                }
            });

            if (clickedCheckbox.checked) {
                clickedCheckbox.parentNode.classList.add('disabled-checkbox');
            }
        }		

		function openCreateModal() {
			document.getElementById('frmAgregarContacto').reset(); // Reset the form
			var modal = document.getElementById('formularioAgregarModal');
			modal.style.display = 'block'; // Show the modal
		}

		function closeModalAgregar() {
			var modal = document.getElementById('formularioAgregarModal');
			modal.style.display = 'none'; // Hide the modal
		}
        
		function closeModalActualizar() {
			var modal = document.getElementById('formularioAgregarModalU');
			modal.style.display = 'none'; // Hide the modal
		}

		// Funciones para modificar y eliminar contactos
        function openModifyModal() {
            var selectedContact = document.querySelector('.contact-radio:checked');

            if (selectedContact) {
                // Usa la ID del contacto seleccionado para obtener los datos del contacto
                obtenerDatosContacto(selectedContact.value);

                var modal = document.getElementById('formularioAgregarModalU');
                modal.style.display = 'block'; // Mostrar el modal
            } else {
                alert('Por favor, seleccione un contacto para modificar.');
            }
        }


        function deleteSelectedContact() {
            var selectedRadio = document.querySelector('input[name="selectedContact"]:checked');
            if (selectedRadio) {
                var contactId = selectedRadio.value;
                eliminarContacto(contactId);  // Suponiendo que tienes una función eliminarContacto() que maneja la eliminación
            } else {
                alert('Por favor, seleccione un contacto para eliminar.');
            }
        }
        
	</script>
</body>


</html>
