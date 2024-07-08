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
// $objDrawing = new PHPExcel_Worksheet_Drawing();
// $objDrawing->setPath('capture/holabb.jpg'); //ruta
// $objDrawing->setHeight(75); //altura
// $objDrawing->setCoordinates('A2');



// incluir una imagen
// $objDrawing = new PHPExcel_Worksheet_Drawing();

    $directory="../capture";
    $dirint = dir($directory);

    while (($archivo = $dirint->read()) !== false){ 
// var_dump($archivo."<br>");
        if($archivo!="." && $archivo!=".."){ $a[]=date("d m Y H:i:s", filectime($directory."/".$archivo))."!".$directory."/".$archivo; }

        }


    $dirint->close();
    arsort($a);
// var_dump($a);
    $i=0;
    foreach ($a as  $arc) {
        $i +=3;
        $posid=strrpos($arc, '!');   
        $clave = substr($arc, ($posid+1));  

        $posid2=strrpos($clave, '/');
        $clave2 = substr($clave, ($posid2+1));

        // <img src="'.$clave.'">
        //       <h4>'.$clave2.'</h4>
// var_dump($clave."<br>");
        
        // $objDrawing->setPath($clave); //ruta
        // $objDrawing->setHeight(45); //altura
        // $objDrawing->setCoordinates('B'.$i);
        // $objDrawing->setCoordinates('B2');
        // $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
        // $objDrawing->setWorksheet($objPHPExcel->getActiveSheet(),true); //incluir la imagen


                         // generación de imágenes
            $objDrawing[$arc] = new PHPExcel_Worksheet_Drawing();
            // $objDrawing[$arc]->setPath($v['L']);
            $objDrawing[$arc]->setPath($clave);
                         //Establecer la altura de ancho
                         $objDrawing[$arc]->setHeight(70); // Altura de la foto
                         // $Objdrawing[$arc]->Setheight(80); // Altura de la foto
                         $objDrawing[$arc]->setWidth(80); // Ancho de la foto
                         // $Objdrawing [$arc] -> SETWIDTH (80); // Ancho de la foto
                         /* Establezca la imagen que se inserte */
            // $objDrawing[$arc]->setCoordinates('L'.$arc);
            $objDrawing[$arc]->setCoordinates('B'.$i);
                         //Distancia de desplazamiento de la imagen
            $objDrawing[$arc]->setOffsetX(12);
            $objDrawing[$arc]->setOffsetY(12);
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