<?php
include("consultar/admin/dataAdmin.php");
$result = new dataAdmin();

if ($rol == "Cliente") {
	$arrReportes = $result->excelCliente($user_name);
} elseif ($rol == "Administrador" || $rol == "Monitorista") {
	$arrReportes = $result->allExcel();
	// var_dump($rol);
	// var_dump($arrReportes);

}



?>
<div class="card-box mb-30">
	<div class="pb-20">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th class="table-plus datatable-nosort">N°</th>

					<th>Img</th>
					<th>Nombre</th>
					<th>Cliente</th>

					<th class="datatable-nosort">Accion</th>
				</tr>
			</thead>
			<tbody id="">
				<?php



				// var_dump($BD);
				//     SELECT COUNT(id), create_date
				// FROM path WHERE name_cliente='GENEX'
				// GROUP BY create_date;


				// var_dump($arrReportes);
				?>

				<?php $i = 1;
				foreach ($arrReportes as $img) {

					// $dataExcel=$result-> dataExcel("GENEX",$img['create_date']);
					$dataExcel = $result->arrAllPathAndDataOfImgCliente($img['name_cliente'], $img['create_date']);

					// var_dump($dataExcel);

					$dataArrPath = serialize($dataExcel);
					// $dataArrPath = urlencode($dataArrPath);

					// echo $error;
					// echo "<br>";
					// echo "<br>";
					// echo "<br>";
				?>
					<tr>
						<td class="table-plus"><?php echo $i ?></td>
						<td><?php echo $img['COUNT(id)'] ?></td>
						<td><?php echo $img['create_date'] ?></td>
						<td><?php echo $img['name_cliente'] ?></td>
						<td>
							<div class="dropdown">
								<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
									<i class="dw dw-more"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
									<!--     <a class="dropdown-item" href="consultar/createExcel.php?data=<?= $dataArrPath ?>" target="_blank"><i class="dw dw-edit2"></i> Descargar</a>  -->

									<a class="dropdown-item" href="PHPMailer/PHPMailer.php?create_date=<?= $img['create_date'] ?>&nameCliente=<?= $img['name_cliente'] ?>&hora=<?= $dataExcel[0]['hora'] ?>&moni=<?= $dataExcel[0]['monitorista'] ?>" target="_blank"><i class="dw dw-edit2"></i> Enviar por correo</a>

									<!-- <a class="dropdown-item" href="vistas/verPdf.php?create_date=<?= $img['create_date'] ?>&nameCliente=<?= $img['name_cliente'] ?>&hora=<?= $dataExcel[0]['hora'] ?>&moni=<?= $dataExcel[0]['monitorista'] ?>" target="_blank"><i class="dw dw-edit2"></i> Ver Pdf</a> -->

									<a class="dropdown-item" href="PHPPdf/PHPPdf.php?create_date=<?= $img['create_date'] ?>&nameCliente=<?= $img['name_cliente'] ?>&hora=<?= $dataExcel[0]['hora'] ?>&moni=<?= $dataExcel[0]['monitorista'] ?>" target="_blank"><i class="dw dw-edit2"></i> Ver Pdf</a>
									<!--                <a class="dropdown-item" href="vistas/verPdf.php?create_date=<?= $img['create_date'] ?>&nameCliente=GENEX&data=<?= $dataArrPath ?>" target="_blank"><i class="dw dw-edit2"></i> Descargar PDF</a> -->
									<!-- <a class="dropdown-item" href="consultar/createExcel.php?create_date=<?= $img['create_date'] ?>&nameCliente=<?= $img['name_cliente'] ?>&data=<?= $dataArrPath ?>" method='post' target="_blank"><i class="dw dw-edit2"></i> Descargar Excel</a> -->
									<form id="downloadExcelForm" action="consultar/createExcel.php" method="post" target="_blank">
										<input type="hidden" name="create_date" value="<?= htmlspecialchars($img['create_date']) ?>">
										<input type="hidden" name="nameCliente" value="<?= htmlspecialchars($img['name_cliente']) ?>">
										<input type="hidden" name="data" value="<?= htmlspecialchars($dataArrPath) ?>">
										<button type="submit" class="dropdown-item"><i class="dw dw-edit2"></i> Descargar Excel</button>
									</form>

								</div>
							</div>
						</td>
					</tr>


				<?php $i++;
				} ?>
			</tbody>
		</table>
	</div>
</div>



<script>

</script>