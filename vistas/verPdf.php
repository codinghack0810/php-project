<?php
session_start();
error_reporting(0);
$user_name = $_SESSION['user_name'];
$nameCliente = $_GET['nameCliente'];
$create_date = $_GET['create_date'];
$hora = $_GET['hora'];
$moni = $_GET['moni'];
$iduser = $_SESSION['iduser'];
include("../consultar/admin/dataAdmin.php");
$result = new dataAdmin();
$dataExcel = $result->arrAllPathAndDataOfImgCliente($nameCliente, $create_date);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/mystyle.css">
	<link rel="stylesheet" type="text/css" href="../css/CSSverPdf.css">
	<title></title>
</head>

<body>
	<div class="card-box mb-30">
		<div class="cabecera">
			<img src="../images/logo.png" alt="" title="" border=0 width=350 height=225>
			<div style="display: flex;">
				<div class="dataT">Cliente: <?= $nameCliente ?></div>
				<div class="dataT">Fecha: <?= $create_date ?></div>
				<div class="dataT">Hora: <?= $hora ?></div>
			</div>
			<div style="display: flex;">
				<div class="dataT">Monitorista: <?= $moni ?></div>
				<div class="dataT"></div>
				<div class="dataT"></div>
			</div>
			<br><br>
			<table>
				<thead>
					<tr>
						<th style=" width: 50px; ">N°</th>
						<th>Descripcion</th>
						<th>Foto</th>
						<th style=" width: 100px; ">Hora</th>
					</tr>
				</thead>
				<tbody id="">
					<?php $i = 1;
					foreach ($dataExcel as $img) {
						$dataArrPath = serialize($dataExcel);
						$dataArrPath = urlencode($dataArrPath);
					?>
						<tr>
							<td style="text-align: center;"><?php echo $i ?></td>
							<td><?= $img['description']  ?></td>
							<td style="text-align: center;"> <img src="<?php echo $img['path'] ?>" alt="" title="" border=0 width=250 height=225></td>
							<td style="text-align: center;">
								<?php
								if ($img['hora_f'] != "") {
								?>
									<div style="display: flex;">
										<div style="margin-right: 8px;">
											<p>Entrada</p>
											<?= $img['hora'] ?>
										</div>
										<div>
											<p>Salida</p>
											<?= $img['hora_f'] ?>
										</div>
									</div>
								<?php
								} else {
									echo $img['hora'];
								}
								?>
							</td>
						</tr>
					<?php $i++;
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	<form style="margin:0px">
		<input type="button" onclick="window.print();" value="Imprimir" style="position:absolute;left:45px;top:14px;z-index:10">
	</form>
</body>

</html>