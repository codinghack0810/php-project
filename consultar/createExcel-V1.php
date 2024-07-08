<?php 
require_once '../functionsExcel/excel.php';
require_once '../PHPExcel/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Developero")
               ->setLastModifiedBy("Maarten Balliauw")
               ->setTitle("Office 2007 XLSX Test Document")
               ->setSubject("Office 2007 XLSX Test Document")
               ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");

$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(10);            

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Lista reproducción')
            ->setCellValue('B1', 'Vídeo')
            ->setCellValue('C1', 'Duración')
            ->setCellValue('D1', 'Url');


// incluir una imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
// $objDrawing->setPath('capture/holabb.jpg'); //ruta
// $objDrawing->setHeight(75); //altura
// $objDrawing->setCoordinates('A2');



// incluir una imagen
// $objDrawing = new PHPExcel_Worksheet_Drawing();

    $directory="capture";
    $dirint = dir($directory);

    while (($archivo = $dirint->read()) !== false){ 
// var_dump($archivo."<br>");
        if($archivo!="." && $archivo!=".."){ $a[]=date("d m Y H:i:s", filectime($directory."/".$archivo))."!".$directory."/".$archivo; }

        }


    $dirint->close();
    arsort($a);
// var_dump($a);
    $i=2;
    foreach ($a as  $arc) {
        $posid=strrpos($arc, '!');   
        $clave = substr($arc, ($posid+1));  

        $posid2=strrpos($clave, '/');
        $clave2 = substr($clave, ($posid2+1));

        // <img src="'.$clave.'">
        //       <h4>'.$clave2.'</h4>
// var_dump($clave."<br>");
        
        $objDrawing->setPath($clave); //ruta
        $objDrawing->setHeight(45); //altura
        $objDrawing->setCoordinates('B'.$i);
        // $objDrawing->setCoordinates('B2');
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet(),true); //incluir la imagen

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

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

$objPHPExcel->getActiveSheet()->setTitle('Informe de vídeos');

$objPHPExcel->setActiveSheetIndex(0);

getHeaders();

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;