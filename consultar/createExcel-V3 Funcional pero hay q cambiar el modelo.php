<?php 
session_start();
error_reporting(0);
$user_name=$_SESSION['user_name'];

if (isset($_GET['data'])) {
    /* Deshacemos el trabajo hecho por 'serialize' */
    $dataArrPath = unserialize($_GET['data']);
    // var_dump($dataArrPath);
    // die($error['error']);
}


    // echo "<br>";
    // echo "<br>";
    // echo "<br>";


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


function cellColor($cells,$color){
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

// $objPHPExcel->setActiveSheetIndex(0)
//             ->setCellValue('A1', 'Lista reproducción')
//             ->setCellValue('B1', 'Vídeo')
//             ->setCellValue('C1', 'Duración')
//             ->setCellValue('D1', 'Url');

  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);

 // $objPHPExcel->getActiveSheet()
 //        ->getStyle('C3')
 //        ->getFill()
 //        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
 //        ->getStartColor()
 //        ->setRGB('4581ed');



cellColor('C3', '4581ed');
cellColor('C4', '4581ed');
cellColor('C5', '4581ed');
cellColor('C6', '4581ed');

 
// $subtitulo->applyFromArray(
//   array('fill' => array( //relleno de color
//       'type' => PHPExcel_Style_Fill::FILL_SOLID,
//       'color' => array('argb' => 'FFCCFFCC')
//     ),
//     'borders' => array( //bordes
//       'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
//       'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
//       'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
//       'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
//     )
// ));



$objPHPExcel->getActiveSheet()->mergeCells("A2:F2"); //unir celdas

$objPHPExcel->getActiveSheet()->mergeCells("A3:B3"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("A3", 'EMPRESA');

// $objPHPExcel->getActiveSheet()->mergeCells("A4:A5"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("A4:B4"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("A5:B5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("A4", 'SUB CATEGORIA');

$objPHPExcel->getActiveSheet()->mergeCells("A6:B6"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("A6", 'MONITORISTA');

$objPHPExcel->getActiveSheet()->mergeCells("C3:D3"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("C4:D4"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("C5:D5"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("D6", 'Fecha :');

// $objPHPExcel->getActiveSheet()->mergeCells("C6:D6"); //unir celdas
// 
$objPHPExcel->getActiveSheet()->mergeCells("E3:F3"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("E4:F4"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("E3", 'TURNO NOCTURNO');




$objPHPExcel->getActiveSheet()->mergeCells("E3:F3"); //unir celdas
$objPHPExcel->getActiveSheet()->mergeCells("E4:F4"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("E5", 'APERTURA');
$objPHPExcel->getActiveSheet()->SetCellValue("F5", 'CIERRE');

$objPHPExcel->getActiveSheet()->SetCellValue("D7", 'Hora :');


// $objPHPExcel->getActiveSheet()->mergeCells("A2:E2"); //unir celdas




// incluir una imagen
// $objDrawing = new PHPExcel_Worksheet_Drawing();
// $objDrawing->setPath('capture/holabb.jpg'); //ruta
// $objDrawing->setHeight(75); //altura
// $objDrawing->setCoordinates('A2');



// incluir una imagen
// $objDrawing = new PHPExcel_Worksheet_Drawing();

//     $directory="../capture/monitor/25_Feb_2022/GENEX";
//     $dirint = dir($directory);

//     while (($archivo = $dirint->read()) !== false){ 
// // var_dump($archivo."<br>");
//         if($archivo!="." && $archivo!=".."){ $a[]=date("d m Y H:i:s", filectime($directory."/".$archivo))."!".$directory."/".$archivo; }

//         }


//     $dirint->close();
//     arsort($a);
// var_dump($a);

foreach($dataArrPath as $img){
    $arrPath[]=$img['path'];
}
//     echo "<br>";

// foreach($a as $img){
//     echo "<br>";
//     var_dump($img);
// }

// echo "<br>";echo "<br>";echo "<br>";
    // $i=0;
    $i=2;
    foreach ($arrPath as  $arc) {
        // $i +=3;
        // $posid=strrpos($arc, '!');   
        // $clave = substr($arc, ($posid+1));  

        // $posid2=strrpos($clave, '/');
        // $clave2 = substr($clave, ($posid2+1));

        // <img src="'.$clave.'">
        //       <h4>'.$clave2.'</h4>
// var_dump($arc."<br>");
        
        // $objDrawing->setPath($clave); //ruta
        // $objDrawing->setHeight(45); //altura
        // $objDrawing->setCoordinates('B'.$i);
        // $objDrawing->setCoordinates('B2');
        // $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
        // $objDrawing->setWorksheet($objPHPExcel->getActiveSheet(),true); //incluir la imagen


                         // generación de imágenes
            $objDrawing[$arc] = new PHPExcel_Worksheet_Drawing();
            // $objDrawing[$arc]->setPath($v['L']);

                         // $Objdrawing [$arc] -> SETWIDTH (80); // Ancho de la foto
                         /* Establezca la imagen que se inserte */
            // $objDrawing[$arc]->setCoordinates('L'.$arc);
// $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "CELDAS UNIDAS");
            if($i==2){
                $objDrawing[$arc]->setPath("../images/logo.png");
                         //Establecer la altura de ancho
                         $objDrawing[$arc]->setHeight(200); // Altura de la foto
                         // $Objdrawing[$arc]->Setheight(80); // Altura de la foto
                         $objDrawing[$arc]->setWidth(400); // Ancho de la foto

                $objDrawing[$arc]->setCoordinates('A'.$i);
  $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(165);
            $objDrawing[$arc]->setOffsetX(200);
            $objDrawing[$arc]->setOffsetY(12);


                $i=$i+18;
            }else{
                $objDrawing[$arc]->setPath($arc);
                         //Establecer la altura de ancho
                         $objDrawing[$arc]->setHeight(70); // Altura de la foto
                         // $Objdrawing[$arc]->Setheight(80); // Altura de la foto
                         $objDrawing[$arc]->setWidth(80); // Ancho de la foto
                $objDrawing[$arc]->setCoordinates('B21');
                // $objDrawing[$arc]->setCoordinates('B'.$i);
  $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(70);
  // $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
              $objDrawing[$arc]->setOffsetX(12);
            $objDrawing[$arc]->setOffsetY(12);
            }
                         //Distancia de desplazamiento de la imagen

            $objDrawing[$arc]->setWorksheet($objPHPExcel->getActiveSheet());








        $i++;
    } 
// $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen





        // $objDrawing->setCoordinates('B2');
        // $x[]= $objPHPExcel->getActiveSheet(); //incluir la imagen
// $objDrawing->setWorksheet($objPHPExcel->getActiveSheet(),true); //incluir la imagen

        // $i++;
    // } 
    // var_dump($x);

    // foreach ($x as  $arc) {
// var_dump($arc);
        // $objDrawing->setWorksheet($arc,true);
    // }
// $objDrawing->setWorksheet($x); //incluir la imagen
// $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
















// fin: incluir una imagen

// $informe = getAllListsAndVideos();
// $i = 2;
// while($row = $informe->fetch_array(MYSQLI_ASSOC))
// {
// $objPHPExcel->setActiveSheetIndex(0)
//             ->setCellValue("A$i", $row['lista'])
//             ->setCellValue("B$i", $row['video'])
//             ->setCellValue("C$i", $row['duracion'])
//             ->setCellValue("D$i", $row['url']);
// $i++;
// }

// $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
// $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
// $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
// $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

$objPHPExcel->getActiveSheet()->setTitle('Informe de vídeos');

$objPHPExcel->setActiveSheetIndex(0);

getHeaders();


// //recorrer las columnas
// foreach (range('B', 'C') as $columnID) {
//   //autodimensionar las columnas
//   $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
// }

for ($i="B"; $i <="C" ; $i++) { 
  // $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
  // $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(70);
  // $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        // code...
}


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;