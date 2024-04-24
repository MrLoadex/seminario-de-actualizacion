

<!-- Modal -->
<!-- The Modal for Creating and Updating Contacts -->
<div id="formularioAgregarModal" class="modal">
	<div class="modal-content">
		<span class="close" onclick="closeModalAgregar()">&times;</span>
		<form id="frmAgregarContacto">
			<label for="nombre">Nombre:</label>
			<input type="text" id="nombre" name="nombre" required><br>
			<label for="apaterno">Apellido Paterno:</label>
			<input type="text" id="apaterno" name="apaterno" required><br>
			<label for="amaterno">Apellido Materno:</label>
			<input type="text" id="amaterno" name="amaterno" required><br>
			<label for="telefono">Número:</label>
			<input type="text" id="telefono" name="telefono" required><br>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required><br>
			<button type="submit" class="button" id="btnAgregarContacto">Guardar</button>
		</form>
</div>


