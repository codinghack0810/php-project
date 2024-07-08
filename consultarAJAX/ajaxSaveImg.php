<?php
session_start();
error_reporting(0);

date_default_timezone_set('America/Mexico_City');

setlocale(LC_TIME, 'spanish');

// if(!isset($iduser)){
//   // var_dump("entro");
// // mysqli_close($con); // Cerrando la conexion

// header('Location: include/cerrar.php'); // Redirecciona a la pagina de inicio
// }



include("../consultar/conexBD.php"); 


$BD= conexion::connect();

// echo date('d/m/y h:i:s A'); echo "<br>";



$iduser=$_SESSION['iduser'];

if((!isset($iduser)) || ($iduser==0)){
    header('Location: ../include/cerrar.php'); // Redirecciona a la pagina de inicio
}


// $BD = new conexion();


//data de todas las imagenes suidas al mismo tiempo
$arrayUpC = $_FILES['uploadCapt'];
// descripcion de la img agregada por el monitorista
$arrDescript=$_POST['description'];


$arCliente=$_POST['arCliente'];
$arCamara=$_POST['arCamara'];
$arHora=$_POST['arHora'];
$arMin=$_POST['arMin'];
$arSeg=$_POST['arSeg'];
$arfechaIMG=$_POST['arfechaIMG'];



$user_name=$_POST['user_name_dir'];

//---------------mantenimiento Dic Genesis amaiz----------------------
$arNameOriginal=$_POST['arNameOriginal'];

//-----------------------------------------------------------------------


// fecha actual
$dateNow= date('d_M_Y');
// direccion de la carpeta con el nombre del usuario
$file_user="capture/".$user_name;
// direccion de la carpeta con el nombre del usuario y la fecha actual
$dir="capture/".$user_name."/".$dateNow."/";


$ano= date('Y');    
$mes= date('m');    
$dia= date('d');
// $H= date('H');
// $i= date('i');
// $s= date('s');
$FAct=$ano."/".$mes."/".$dia;


//ESTO es para saber si el boton de guardar imagenes fue precionado para limpiar el input
$saveNewImg=$_POST['saveNewImg'];



// var_dump($arrayUpC);
// var_dump($arrDescript."<br><br><br>");

// var_dump($dir."<br>");
// var_dump($file_user."<br>");
// var_dump($description);

basename($_FILES['uploadCapt']['name']);
// print_r($arrayUpC);
// $description =$_POST['description'];

if($saveNewImg!="" && $saveNewImg=="Guardar Imagenes"){
    // CREAR CARPETA DEL USUARIO SINO EXISTE 
    if (!file_exists($file_user)) {mkdir("../".$file_user);}
    // CREAR CARPETA DE la fecha actual dentro de la carpeta del usuario 
    if (!file_exists($dir)) {mkdir("../".$dir);}


    
    // var_dump($arrayUpC);
    foreach($arrayUpC as $key=>$var){
         // var_dump("key --> ".$var."<br><br>");
        if($key=="name"){
            // $key name es un array con todos los nombres de las imagenes
            $arrnameCap = $arrayUpC["name"];
            $arrtmp_nameCap = $arrayUpC["tmp_name"];


            // var_dump("arrnamecap --> ".$arrnameCap."<br>");
            //   var_dump("var ".$var."<br>");
            //   // $i++;
            // echo "{$key} => {$var} ";
             // print_r($arrayUpC);
            // var_dump("arrtmp_nameCap --> ".$arrtmp_nameCap[0]."<br>");
            // var_dump($arrtmp_nameCap[0]);
            // var_dump($arrtmp_nameCap[0]);
            
            $i=0;
            foreach($arrnameCap as $key){
                // var_dump($arrDescript);
                // echo "<br>";echo "<br>";echo "<br>";
                $description = $arrDescript[$key];
                $NameCliente = $arCliente[$key];
                $NameCamara = $arCamara[$key];
                $Hora = $arHora[$key];
                $Min = $arMin[$key];
                $Seg = $arSeg[$key];
                $fechaIMG = $arfechaIMG[$key];

                // extraer nombre de las imagenes uno por uno
                $nameCap = $key;


//---------------mantenimiento Dic Genesis amaiz----------------------
                $NameOriginal = $arNameOriginal[$key];
//-----------------------------------------------------------------------

                // var_dump($arrDescript."<br><br><br>");
                // echo "<br>";echo "<br>";echo "<br>";
                // var_dump($i);
                // echo "<br>";echo "<br>";echo "<br>";




                // var_dump($nameCap."<br><br>");
                // dividir y extraer data del name cap
                // $dataNameCap = explode("_", $nameCap);
                // extraer solo el nombre del cliente
                // $nameCliente = $dataNameCap[0]; 
                $nameCliente = $NameCliente; 
                // $hora = $dataNameCap[1]; 
                $hora = $Hora."-".$Min."-".$Seg; 
                // Eliminar los espacios vacios del nombre
                $searchString = " ";
                $replaceString = "";
                $originalString = $nameCliente; 
                $outputString = str_replace($searchString, $replaceString, $originalString); 
                // convertir de minuscula a mayuscula
                $nameCliente = strtoupper($outputString);



                $total_img = count(glob($dir.$nameCliente.'/{*.jpg}',GLOB_BRACE));

                // echo 'ruta = '.$dir.$nameCliente.": ";
                // echo 'total_imagenes = '.$total_img."<br>";

                $n= "-numero_".($total_img+1);
                // var_dump($total_img);       
    




                // ARMAR NOMBRE IMG UNO POR UNO
                
 
                // $dir_capt = "../".$dir.$nameCliente."/".$nameCliente."_".$NameCamara."_".$dateNow."_".$hora."_".$n.".jpg";
                
              
                $dir_capt = "../".$dir.$nameCliente."/".$nameCliente."_".$NameCamara."_".$dateNow."_".$hora.".jpg";
                $newNameImg= $nameCliente."_".$NameCamara."_".$dateNow."_".$hora.".jpg";

                // PRUEBA
                // $dir_capt = "../".$dir.$nameCliente."/".$nameCliente."_".$description."_".$dateNow."_".$hora."_".$n.".jpg";


                if ($fechaIMG==$FAct) {
                    // code...

                    // CREAR CARPETA DEl cliente dentro de la carpeta con la fecha actual y segun el usuario  
                    if (!file_exists($dir.$nameCliente)) {mkdir("../".$dir.$nameCliente);}

                    // var_dump($dir_capt);
                    // var_dump($i);
                    // echo "<br>";echo "<br>";echo "<br>";
                    // var_dump("arrtmp_nameCap --> ".$arrtmp_nameCap[$i]."<br>");


                    $sql="SELECT path FROM path WHERE path='".$dir_capt."'";
                    $res = mysqli_query( $BD, $sql );

                    if (mysqli_num_rows($res)>0) {
                        
                        $msj.= "<img class='pointico' src='images/alert-icon.png' height='25px'> Dato duplicado. Img ya registrada. <br>".$newNameImg."<br><br>";


                    }else{

                        // Guardar imagenes uno por uno
                        if (move_uploaded_file($arrtmp_nameCap[$i], $dir_capt)) {
                            // echo "El archivo ". $arrnameCap[$i]. " se cargo.";
                            // $msj.= "La img ". $dir_capt. " se cargo en la Carpeta.";
                            $msj2 = "La img ". $newNameImg. " se cargo en la Carpeta.";



                            // $sql="INSERT INTO `path` (`path`, `description`, `create_date`, `hora`, `name_cliente`, `id_monitor`,`name_camara`,`registre_date`) VALUES ('$dir_capt', '$description', '$dateNow','$Hora:$Min:$Seg', '$NameCliente', '$iduser','$NameCamara',localtimestamp)";
                            $ano= date('Y');    
                            $mes= date('m');    
                            $dia= date('d');
                            $H= date('H');
                            $mi= date('i');
                            $s= date('s');  

                            $date_register=$ano."-".$mes."-".$dia." ".$H.":".$mi.":".$s;

                            $sql="INSERT INTO `path` (`path`, `description`, `create_date`, `hora`, `name_cliente`, `id_monitor`,`name_camara`,`registre_date`) VALUES ('$dir_capt', '$description', '$dateNow','$Hora:$Min:$Seg', '$NameCliente', '$iduser','$NameCamara','$date_register')";


          

                            // var_dump($iduser);
                            // var_dump($sql);

                            if((!isset($iduser)) || ($iduser==0)){
                                ?><script type="text/javascript">alert("!! Se perdío la session, tiene que iniciar nuevamente !!");</script><?php
                                header('Location: ../include/cerrar.php'); // Redirecciona a la pagina de inicio
                            }

                            // $resultado = mysqli_query( $BD, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                            $resultado = mysqli_query( $BD, $sql );

    // 
    // var_dump(mysqli_num_rows($resultado));
    // var_dump($resultado);

                            if ($resultado) {
                              // $messages[] = "Los datos han sido procesados exitosamente.";
                              $msj.= "<img class='pointico' src='images/check.png' height='25px'> registro exitoso en la BD. <br>".$msj2."<br><br>";
                            } else {

                                // $sql="SELECT path FROM path WHERE path='".$dir_capt."'";
                                // $res = mysqli_query( $BD, $sql );

                                // if (mysqli_num_rows($resultado)>0) {
                                    
                                //     $msj.= "<img class='pointico' src='images/eliminar.png' height='25px'> Dato duplicado. Img ya registrada. <br>".$msj2."<br><br>";


                                // }else{
                                    // $messages[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo. ".mysqli_error($con);
                                    $msj.= "<img class='pointico' src='images/eliminar.png' height='25px'> el registro falló en la BD. <br>".$msj2."<br><br>";
                                // }
                            }

                        } else {
                            $msj.= "Operacion fallida, hubo un error durante la carga del archivo. <br>";
                        }
                    }
                }else{
                    $msj2 = "La img ". $newNameImg. " .";

                    $msj.= "<img class='pointico' src='images/eliminar.png' height='25px'> El registro falló porque la fecha de la imagen no corresponde a la fecha actual. <br>".$msj2."<br> NameO: <b>".$NameOriginal."</b><br><br>";
                }

                // var_dump("dir --> ".$dir."<br>");
                // var_dump("dir_capt --> ".$dir_capt."<br>");
                // var_dump("arrtmp_nameCa$i --> ".$arrtmp_nameCap[$i]."<br>");
                $i++;
                // $arrayUpC ="";
            }


            // var_dump($msj);
?>
<!-- <script type="text/javascript">alert("!! <?php echo $msj;  ?> !!");</script> -->
<!-- <script type="text/javascript">
    var msj = "<?php echo $msj; ?>" ;

    document.getElementById("lista_imagenes").innerHTML= msj;
</script> -->



<script type="text/javascript">window.location="../boddy.php?LI=<?php echo $msj;?>";</script>



<?php             
        }

    }
}
// var_dump($_FILES["uploadCapt"]);
// var_dump($dir_capt);
// var_dump($arrayUpC);
// var_dump($arrayUpC2);
// var_dump($nameCap);

?>