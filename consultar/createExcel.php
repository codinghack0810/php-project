<?php

use Sabberworm\CSS\Value\Value;

session_start();
error_reporting(0);

$user_name = $_SESSION['user_name'];
$nameCliente = $_POST['nameCliente'];
$create_date = $_POST['create_date'];
$data = $_POST['data'];

// var_dump($data);

function is_serialized($value)
{
	if (!is_string($value)) {
		return false;
	}
	$data = @unserialize($value);
	return $data !== false || $value === 'b:0;';
}

if (isset($data)) {
	if (is_serialized($data)) {
		$dataArrPath = unserialize($data);
		// var_dump($dataArrPath);
		// Proceed with $dataArrPath
	} else {
		var_dump('The provided data is not a valid serialized string.');
	}
}

require_once '../functionsExcel/excel.php';
require_once '../PHPExcel/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();
// $objPHPExcelStyle = new PHPExcel_Style(); //nuevo estilo

// Set document properties
$objPHPExcel->getProperties()->setCreator("Developero")
	->setLastModifiedBy("Maarten Balliauw")
	->setTitle("Office 2007 XLSX Test Document")
	->setSubject("Office 2007 XLSX Test Document")
	->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
	->setKeywords("office 2007 openxml php")
	->setCategory("Test result file");

function cellColor($cells, $color)
{
	global $objPHPExcel;

	$objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'startcolor' => array(
			'rgb' => $color
		)
	));
}

$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
	->setSize(10);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->mergeCells("A2:C2"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("A3", 'Cliente: ' . $nameCliente);
$objPHPExcel->getActiveSheet()->SetCellValue("A4", 'Monitorista: ' . $dataArrPath[0]['monitorista']);
$objPHPExcel->getActiveSheet()->SetCellValue("B3", 'Fecha: ' . $create_date);
$objPHPExcel->getActiveSheet()->SetCellValue("C3", 'Hora: ' . $dataArrPath[0]['hora']);
$objPHPExcel->getActiveSheet()->SetCellValue("B6", 'REPORTE');
$objPHPExcel->getActiveSheet()->SetCellValue("A7", 'Descripcion');
$objPHPExcel->getActiveSheet()->SetCellValue("B7", 'Foto');
$objPHPExcel->getActiveSheet()->SetCellValue("C7", 'Hora');

foreach ($dataArrPath as $img) {
	$arrPath[] = $img['path'];
	$arrHora[] = $img['hora'];
	$arrHora_f[] = $img['hora_f'];
	$arrMonitorista[] = $img['monitorista'];
	$arrDescription[] = $img['description'];
}


$i = 2;
$j = -1;
$moni = "";
array_unshift($arrPath, "");
// var_dump($arrPath);

foreach ($arrPath as  $arc) {
	$objDrawing[$arc] = new PHPExcel_Worksheet_Drawing();

	if ($i == 2) {
		$objDrawing[$arc]->setPath("../images/logo.png");
		//Establecer la altura de ancho
		$objDrawing[$arc]->setHeight(200); // Altura de la foto
		// $Objdrawing[$arc]->Setheight(80); // Altura de la foto
		$objDrawing[$arc]->setWidth(400); // Ancho de la foto

		$objDrawing[$arc]->setCoordinates('A' . $i);
		$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(165);
		$objDrawing[$arc]->setOffsetX(150);
		$objDrawing[$arc]->setOffsetY(12);


		$i = $i + 5;
	} else {

		if ($moni != "" && $moni != $arrMonitorista[$j]) {
			$objPHPExcel->getActiveSheet()->SetCellValue("A" . $i, "Cambio de Turno");
			$objPHPExcel->getActiveSheet()->SetCellValue("B" . $i, $arrMonitorista[$j]);
			$i = $i + 1;
		}

		$objDrawing[$arc]->setPath($arc);

		$objPHPExcel->getActiveSheet()->SetCellValue("A" . $i, $arrDescription[$j]);

		if ($arrHora_f[$j] != "") {
			$objPHPExcel->getActiveSheet()->SetCellValue("C" . $i, $arrHora[$j] . " - " . $arrHora_f[$j]);
		} else {
			$objPHPExcel->getActiveSheet()->SetCellValue("C" . $i, $arrHora[$j]);
		}

		//Establecer la altura de ancho
		$objDrawing[$arc]->setHeight(150); // Altura de la foto
		$objDrawing[$arc]->setWidth(195); // Ancho de la foto

		$objDrawing[$arc]->setCoordinates('B' . $i);
		$objDrawing[$arc]->setOffsetX(12);
		$objDrawing[$arc]->setOffsetY(12);

		$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(120);

		$moni = $arrMonitorista[$j];
	}
	$objDrawing[$arc]->setWorksheet($objPHPExcel->getActiveSheet());
	$i++;
	$j++;
}

$objPHPExcel->getActiveSheet()->setTitle('Informe de vídeos');

$objPHPExcel->setActiveSheetIndex(0);

getHeaders();
for ($i = "B"; $i <= "C"; $i++) {
	// $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
	// $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(70);
	// $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
	// code...
}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
