
<?php 
	require_once "../../clases/Conexion.php";
	$con = new Conexion();
	$conexion = $con->conectar();

	$sql = "SELECT 
		contactos.paterno AS paterno,
		contactos.materno AS materno,
		contactos.nombre AS nombre,
		contactos.telefono AS telefono,
		contactos.email AS email,
		contactos.id_contacto AS idContacto
	FROM
		t_contactos AS contactos";

	$result = mysqli_query($conexion, $sql);
 ?>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-condensed" id="tablaContactosDT">
                <thead>
                    <tr>
                        <th>Editar</th>
                        <th>Apellido paterno</th>
                        <th>Apellido materno</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while($mostrar = mysqli_fetch_array($result)) {  
                            $idContacto = $mostrar['idContacto'];
                    ?>
                    <tr>
                        <td>
                            <input type="radio" name="selectedContact" value="<?php echo $idContacto ?>" class="contact-radio">
                        </td>
                        <td><?php echo htmlspecialchars($mostrar['paterno']); ?></td>
                        <td><?php echo htmlspecialchars($mostrar['materno']); ?></td>
                        <td><?php echo htmlspecialchars($mostrar['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($mostrar['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($mostrar['email']); ?></td>
                        <td>
                            <span class="btn btn-warning btn-sm" onclick="obtenerDatosContacto('<?php echo $idContacto ?>')" data-toggle="modal" data-target="#modalActualizarContacto">
                                <span class="fas fa-edit"></span>
                            </span>
                        </td>
                        <td>
                            <span class="btn btn-danger btn-sm" onclick="eliminarContacto('<?php echo $idContacto ?>')">
                                <span class="far fa-trash-alt"></span>
                            </span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#tablaContactosDT').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": [0, 6, 7]
            }]
        });
    });
</script>

