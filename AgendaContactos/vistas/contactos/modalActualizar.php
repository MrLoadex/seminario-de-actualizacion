

<!-- Modal -->
<!-- The Modal for Creating and Updating Contacts -->
<div id="formularioAgregarModalU" class="modal">
	<div class="modal-content">
		<span class="close" onclick="closeModalActualizar()">&times;</span>
		<form id="frmAgregarContactoU">
			<input type="text" id="idContactoU" name="idContacto" hidden="">
			<label for="nombre">Nombre:</label>
			<input type="text" id="nombreU" name="nombre" required><br>
			<label for="apaterno">Apellido Paterno:</label>
			<input type="text" id="apaternoU" name="apaterno" required><br>
			<label for="amaterno">Apellido Materno:</label>
			<input type="text" id="amaternoU" name="amaterno" required><br>
			<label for="telefono">Número:</label>
			<input type="text" id="telefonoU" name="telefono" required><br>
			<label for="email">Email:</label>
			<input type="email" id="emailU" name="email" required><br>
			<button type="submit" class="button" id="btnActualizarContacto">Modificar</button>
		</form>
</div>


