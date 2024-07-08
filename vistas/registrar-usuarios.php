<?php
include("consultar/admin/dataAdmin.php");
$result = new dataAdmin();
$nameRol = $result->allRolUser();
$Elegir = "Elegir";

?>

<!-- <div id="idstate"></div> -->


<form method='POST' action='' enctype='multipart/form-data'>
	<?php

	?>

	<!-- <div class=""> -->
	<h4 class="title">Nuevo Usuario</h4>
	<div class="blog-by">
		<form>
			<div class="form-group">
				<label>Nombre de Usuario</label>
				<input class="form-control" type="text" id="user_name" value="<?php echo $resulComp[0]['name_company'] ?>" placeholder="Nombre" onkeyup="mayus(this);" onkeypress="return isESLetterNoSpace(event,this); ">
			</div>
			<div class="form-group">
				<label>Correo del usuario</label>
				<input class="form-control" type="email" id="user_mail" value="<?php echo $resulComp[0]['email'] ?>" placeholder="Correo" onkeyup="bajar(this);" onkeypress="return isMail(event,this); ">
			</div>
			<!-- 				<div class="form-group">
					<label>Correo Electronico</label>
					<input class="form-control"  id="email1" value="<?php echo $resulComp[0]['email'] ?>" type="email">
				</div> -->
			<!-- 				<div class="form-group">
					<label>Telefono</label>
					<input class="form-control"  id="phone1" value="<?php echo $resulComp[0]['phone'] ?>" type="tel">
				</div> -->
			<!-- 				<div class="form-group">
					<label>Direccion</label>
					<textarea class="form-control" id="address1" ><?php echo $resulComp[0]['address'] ?></textarea>
				</div> -->
			<div class="form-group">
				<label>Tipo de Usuario</label>
				<select id="id_userRol" class="custom-select col-12">
					<option selected=""><?php echo $Elegir ?>...</option>
					<?php foreach ($nameRol as $stat) { ?>
						<option value="<?php echo $stat['id'] ?>">
							<?php echo $stat['name'] ?>
						</option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group">
				<label>Contraseña</label>
				<input class="form-control" id="password" value="<?php echo $resulComp[0]['phone'] ?>" type="password" suggested="new-password" placeholder="Contraseña">
			</div>
			<div class="form-group">
				<label>Confirmar Contraseña</label>
				<input class="form-control" id="confirmPassword" value="<?php echo $resulComp[0]['phone'] ?>" type="password" suggested="new-password" placeholder="Contraseña" onblur="return compararpasswFailed(event,this,'confirmPassword','password')" onkeyup="return compararpasswTrue(event,this,'confirmPassword','password')" autocomplete="on">
			</div>
			<div class="row">
				<div class="col-md-3 col-3">
					<button type="button" class="btn btn-primary" name="update" onclick="userInfo();">Guardar</button>

				</div>
			</div>
		</form>
	</div>
	<!-- </div> -->


</form>


<script>
	function compararpasswFailed(e, field, id, id2 = "") {
		var val1 = field.value;
		var item1 = document.getElementById(id);
		var item2 = document.getElementById(id2);
		var val2 = item2.value;

		if (val1 != val2) {
			item1.style.border = "#ff6161db 0.15rem dashed";
			item2.style.border = "#ff6161db 0.15rem dashed";
		}
	}

	function compararpasswTrue(e, field, id, id2 = "") {
		var val1 = field.value;
		var item1 = document.getElementById(id);
		var item2 = document.getElementById(id2);
		var val2 = item2.value;

		if (val1 == val2) {
			item1.style.border = "none";
			item2.style.border = "none";
		}
	}

	function userInfo() {
		var funcion1 = "insertUser";
		// var full_name=$("#full_name").val();
		// var email=$("#email").val();
		var user_name = $("#user_name").val();
		var user_mail = $("#user_mail").val();
		var id_userRol = $("#id_userRol").val();
		var password = $("#password").val();
		var confirmPassword = $("#confirmPassword").val();

		if (password == confirmPassword) {

			$.post("consultarAJAX/ajaxFunction.php", {
				funcion1: funcion1,
				user_name: user_name,
				user_mail: user_mail,
				id_rol: id_userRol,
				"password": password
			}, function(data) {
				// $("#idstate").html(data);  
				if (data == 1) {
					// $(this).attr("value","N");
					alert("Los datos han sido procesados exitosamente");
					$("#user_name").val("");
					$("#user_mail").val("")
					$("#id_userRol").val("");
					$("#password").val("");
					$("#confirmPassword").val("");

				} else if (data == 2) {
					alert("Nombre de usuario ya existe");
				} else {
					alert("Lo sentimos , el registro falló.");
				}
			});
		} else {
			$("#password").attr('style', 'border: #ff6161db 0.15rem dashed');
			$("#confirmPassword").attr('style', 'border: #ff6161db 0.15rem dashed');
		}
	}
</script>