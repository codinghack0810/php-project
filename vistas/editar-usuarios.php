<?php
include("consultar/admin/dataAdmin.php");
$result = new dataAdmin();
$nameRol = $result->allRolUser();
$Elegir = "Elegir";

?>

<form method='POST' action='' enctype='multipart/form-data'>
	<?php

	?>

	<!-- <div class=""> -->
	<h4 class="title">Cambio de Contraseña del Usuario</h4>
	<div class="blog-by">
		<form>
			<div class="form-group">
				<label>ID del Usuario</label>
				<input type="text" id="idEditPass" name="iduser" class="form-control" disabled>
			</div>
			<div class="form-group">
				<label>Nombre de Usuario</label>
				<input class="form-control" type="text" id="nameEditPass" value="<?php echo $resulComp[0]['name_company'] ?>" placeholder="Nombre" onkeyup="mayus(this);" onkeypress="return isESLetterNoSpace(event,this); ">
			</div>
			<div class="form-group">
				<label>Correo del usuario</label>
				<input class="form-control" type="email" id="mailEditPass" value="<?php echo $resulComp[0]['email'] ?>" placeholder="Correo" onkeyup="bajar(this);" onkeypress="return isMail(event,this); ">
			</div>
			<div class="form-group">
				<label>Tipo de Usuario</label>
				<input class="form-control" type="text" id="rolEditPass" value="<?php echo $resulComp[0]['name_company'] ?>" placeholder="Tipo de usuario" disabled>
			</div>
			<div class="form-group">
				<label>Nueva Contraseña</label>
				<input class="form-control" id="newPassword" value="<?php echo $resulComp[0]['phone'] ?>" type="password" placeholder="Contraseña">
			</div>
			<div class="form-group">
				<label>Confirmar Contraseña</label>
				<input class="form-control" id="newConfirmPassword" value="<?php echo $resulComp[0]['phone'] ?>" type="password" placeholder="Repetir Contraseña" onblur="return compararpasswFailed(event,this,'newConfirmPassword','newPassword')" onkeyup="return compararpasswTrue(event,this,'newConfirmPassword','newPassword')" autocomplete="on">
			</div>
			<div class="row">
				<div class="col-md-3 col-3">
					<button type="button" class="btn btn-primary" name="update" onclick="editPass();">Guardar</button>

				</div>
			</div>
		</form>
	</div>
	<!-- </div> -->


</form>


<script>
	// function compararpasswFailed(e, field,id,id2=""){
	//   var val1  = field.value;
	//   var item1 = document.getElementById(id);
	//   var item2 = document.getElementById(id2);
	//   var val2  = item2.value;

	//   if (val1!=val2) {    
	//     item1.style.border= "#ff6161db 0.15rem dashed";
	//     item2.style.border= "#ff6161db 0.15rem dashed";
	//   }
	// }

	// function compararpasswTrue(e, field,id,id2=""){
	//   var val1  = field.value;
	//   var item1 = document.getElementById(id);
	//   var item2 = document.getElementById(id2);
	//   var val2  = item2.value;

	//   if (val1==val2) {    
	//     item1.style.border= "none";
	//     item2.style.border= "none"; 
	//   }
	// }

	function editPass() {
		var funcion1 = "editPass";
		var id = $("#idEditPass").val();
		var nameUser = $("#nameEditPass").val();
		var mailUser = $("#mailEditPass").val();
		var newPassword = $("#newPassword").val();
		var newConfirmPassword = $("#newConfirmPassword").val();

		if (id != "" && nameUser != "" && newPassword != "") {
			if (newPassword == newConfirmPassword) {

				$.post("consultarAJAX/ajaxFunction.php", {
					funcion1: funcion1,
					id: id,
					newPassword: newPassword,
					nameUser: nameUser,
					mailUser: mailUser,
				}, function(data) {
					// $("#idstate").html(data);  
					if (data == 1) {
						// $(this).attr("value","N");
						alert("Los datos han sido procesados exitosamente");
						$("#idEditPass").val("");
						$("#nameEditPass").val("");
						$("#mailEditPass").val("");
						$("#rolEditPass").val("");
						$("#newPassword").val("");
						$("#newConfirmPassword").val("");
						showView(event, this, 'SearchUser');
					} else {
						alert("Lo sentimos , la modificación falló.");
						// alert(data);     
					}
				});
			} else {
				$("#newPassword").attr('style', 'border: #ff6161db 0.15rem dashed');
				$("#newConfirmPassword").attr('style', 'border: #ff6161db 0.15rem dashed');
			}
		} else {
			alert("Todos los datos son necesarios, por favor revise.");
		}


	}
</script>