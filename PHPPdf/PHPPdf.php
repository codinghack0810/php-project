<?php
// Start output buffering
ob_start();

session_start();
error_reporting(0);
$user_name = $_SESSION['user_name'];
$user_mail = $_SESSION['user_mail'];
$nameCliente = $_GET['nameCliente'];
$create_date = $_GET['create_date'];
$hora = $_GET['hora'];
$moni = $_GET['moni'];
$iduser = $_SESSION['iduser'];
include('../consultar/admin/dataAdmin.php');
$result = new dataAdmin();
$dataExcel = $result->arrAllPathAndDataOfImgCliente($nameCliente, $create_date);

// Include autoloader 
//Make sure you link the file correctly using your own localhost url
require 'vendor/autoload.php';

// Reference the Dompdf namespace 
use Dompdf\Dompdf;

// Instantiate and use the dompdf class 
$dompdf = new Dompdf();


$html = '
<style>
    .card-box {
    padding: 50px 50px 50px 50px;
}

.cabecera{
        text-align: -webkit-center;
}
.dataT{
    width: 300px;
}

table thead tr th {
    width: 300px;
    background: #4bb1f7;

}

table tbody tr td {
    border: 1px solid #c3c1c1;

}


</style>';

function convertImageToBase64($path)
{
    $substringToRemove = "../";
    $path = str_replace($substringToRemove, "", $path);
    $path = str_replace(" ", '%20', $path);
    $path = 'http://monitorcenter.com.mx/' . $path;
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $ch = curl_init($path);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    return $base64;
}

$html .= '
<div class="card-box mb-30">
    <div class="cabecera">
        <img style="text-align: center; padding-left: 150px;" src="' . convertImageToBase64('../images/logo.png') . '" alt="../images/logo.png" title="" border=0 width=300 height=135>
        <div style="display: flex; flex-direction: row;">
            <div class="dataT">Cliente: ' . $nameCliente . '</div>
            <div class="dataT">Fecha: ' . $create_date . '</div>
            <div class="dataT">Hora: ' . $hora . '</div>
        </div>
        <div style="display: flex;">
            <div class="dataT">Monitorista: ' . $moni . '</div>
            <div class="dataT"></div>
            <div class="dataT"></div>
        </div>
        <br><br>
        <table>
            <thead>
                <tr>
                    <th style=" width: 50px; ">No</th>
                    <th style="width: 210px;">Descripcion</th>
                    <th style="width: 260px;">Foto</th>
                    <th style=" width: 70px; ">Hora</th>
                </tr>
            </thead>
            <tbody id="">';
$i = 1;
foreach ($dataExcel as $img) {
    $dataArrPath = serialize($dataExcel);
    $dataArrPath = urlencode($dataArrPath);

    $html .= '
                <tr>
                    <td style="text-align: center;">' . $i . '</td>
                    <td style="text-align: center;">' . $img['description'] . '</td>
                    <td style="text-align: center;"> <img src="' . convertImageToBase64($img['path']) . '" alt="' . $img['path'] . '" title="" border=0 width=250 height=225></td>
                    <td style="text-align: center;">';

    if ($img['hora_f'] != "") {
        $html .= '
                        <div style="display: flex;">
                            <div style="margin-right: 8px;">
                                ' . $img['hora'] . '
                                <p>-</p>
                                ' . $img['hora_f'] . '
                            </div>
                        </div>';
    } else {
        $html .= $img['hora'];
    }

    $html .= '
                    </td>
                </tr>';

    $i++;
}

$html .= '
            </tbody>
        </table>
    </div>
</div>';
// Load HTML content 
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF 
$dompdf->render();

// Output the generated PDF to a file on the server
// $dompdf->output();

// Discard the output buffer
ob_end_clean();

// Output the generated PDF to Browser 
$dompdf->stream('monitercenter to ' . $user_name . '.pdf', array("Attachment" => false));

// Get the generated PDF content
$pdfContent = $dompdf->output();

// Specify the file path and name to save the PDF
$filePath = __DIR__ . '/PDF/' . $user_name . '.pdf';

// Save the PDF file to the specified path
file_put_contents($filePath, $pdfContent);

// Specify the file path and name of the PDF file
// $filePath = __DIR__ . '/PDF/' . $user_name . '.pdf';

// Delete the PDF file
// unlink($filePath);

// Specify the file path and name of the PDF file
// $filePath = __DIR__ . '/PDF/' . $user_name . '.pdf';

// Register a shutdown function to delete the PDF file
// register_shutdown_function(function () use ($filePath) {
//     // Check if the PDF file exists
//     if (file_exists($filePath)) {
//         // Delete the PDF file
//         unlink($filePath);
//     }
// });
