<?php
session_start();
error_reporting(0);

$iduser=$_SESSION['iduser'];

if((!isset($iduser)) || ($iduser==0)){
    header('Location: ../include/cerrar.php'); // Redirecciona a la pagina de inicio
}


function rmdir_recursive($dir) {
    $files = scandir($dir);
    array_shift($files);    // remove '.' from array
    array_shift($files);    // remove '..' from array
   
            // $CalendarioLista = new CalendarioListaDAO(); eliminar en la BD
    foreach ($files as $file) {
        $file = $dir . '/' . $file;
        if (is_dir($file)) {
            rmdir_recursive($file);
            rmdir($file);
        } else {
            if(is_file($file) && unlink($file)==true){
                // unlink($file);
                // $CalendarioLista->eliminarArchivo($file);
                // var_dump("Entro a eliminar a: ".$file);
                echo "1";
            }
            
        }
    }
    rmdir($dir);
    if(is_file($dir) && unlink($dir)==true){
        // unlink($dir);
        // $CalendarioLista->eliminarArchivo($dir);
        // var_dump("Entro a eliminar a: ".$dir);
                echo "2";
        
    }

}


if(!$_POST){die();}
$action=$_POST["acc"];
switch ($action) {



    case 'showImg':
// $ruta =$_POST['ruta_actual']; 
$path =$_POST['ruta_actual']; 
$back_url =$_POST['back_url']; 
$rol =$_POST['rol']; 
$cant=0;



foreach(scandir("../".$path) as $dirr ){

    if($dirr !="." && $dirr !=".." && is_dir("../".$path."/".$dirr)){ 
        $cant++; 

    ?>
    <tr>

        <td class="table-plus"><?php echo $cant ?></td>
        
        <td class="cont_union"> 

<?php
    if($back_url==1 ||  ($back_url==0 && $rol=="Administrador")){
        ?>
<img class="pointico" src="images/carpeta.png" height="35px" onclick="showRuta('<?php echo $path."/".$dirr; ?>')">
<p onclick="showRuta('<?php echo $path."/".$dirr; ?>')" class="pointico p"><?php echo $dirr; ?><p>
        <?php
    
    }else{
        ?>
<img class="pointico" src="images/carpeta.png" height="35px" onclick="showImg('<?php echo $path."/".$dirr; ?>')">
<p onclick="showImg('<?php echo $path."/".$dirr; ?>')" class="pointico p"><?php echo $dirr; ?><p>
        <?php
    }
?>
            


            </td>
       
<?php
    if($rol=="Administrador"){
?>         
        <td>
            <div class="dropdown">
                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <i class="dw dw-more"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="#" onclick="eliminar('<?php echo '../'.$path."/".$dirr; ?>','<?php echo $path?>')"><i class="dw dw-edit2"></i> Eliminar</a>
                </div>
            </div>
        </td>
<?php
    }
?>
    </tr>
    <?php   
    }
}





if($cant==0 && is_file("../".$path."/".$dirr)){
    $dirrectory=$path;
    $dirrint = dir("../".$dirrectory);

    while (($archivo = $dirrint->read()) !== false){ 
        if($archivo !="." && $archivo !=".." && is_file("../".$path."/".$archivo)){            
            $a[]=$dirrectory."/".$archivo;           
        }
    }        
    $dirrint->close();
    arsort($a);
    // var_dump($a);
    
    $i=0; 
    foreach ($a as  $arc) {
        $posid=strrpos($arc, '!');   
        $clave = substr($arc, ($posid));  
        $posid2=strrpos($clave, '/');
        $clave2 = substr($clave, ($posid2+1));

        echo '<div   name="NameImg"  value="'.$clave2.'" style="border-radius: 0rem 0rem 0.5rem 0.5rem;float: left; display:grid; ">
                <div style="display:flex;">'; 

    if($rol=="Administrador"){

        echo '
                    <div onclick="eliminar('."'../$clave'".','."'$path'".')">
                        <img class="pointico" src="images/eliminar.png" height="25px">
                    </div>
        '; 

    }
        // echo '
        //             <div onclick="agregarHoraDeSalida('."'../$clave'".','."'$path'".','."'$i'".')">
        //                 <img id="idIcoEditHF'.$i.'" class="pointico classIcoEditHF" title="Añadir Hora de salida" src="images/ico-editar.png" height="25px">
        //             </div>
        //         </div>
        //         <img src="'.$clave.'"  style="width: 150px; height: 200px;">
        //         <label id="titleHF'.$i.'" style="display:none;">Agregar Hora de salida:</label>
        //         <div style="display:flex;">
        //             <input id="hora_f'.$i. '" name="hora_salida" type="text"   style="width: 7em;margin-top: -5px;border-radius: 0.3rem;box-shadow: 0px 1px 3px black; display:none;" placeholder="descripción" onkeyup="return str_staticlengthstyle(event,this,'."'hora_f$i'".'); ">
        //             <div id="ico_save'.$i.'" style="display:none;" onclick="saveHoraDeSalida('."'../$clave'".','."'$path'".','."'$i'".')">
        //                 <img class="pointico" title="Añadir Hora de salida" src="images/guardar.png" height="25px">
        //             </div>
        //         </div>
        //     </div>';
        echo '
                    <div onclick="agregarDescripcion('."'../$clave'".','."'$path'".','."'$i'".')">
                        <img id="idIcoEditHF'.$i.'" class="pointico classIcoEditHF" title="Añadir Hora de salida" src="images/ico-editar.png" height="25px">
                    </div>
                </div>
                <img src="'.$clave.'"  style="width: 230px; height: 230px; padding:2px;">
                <label id="titleHF'.$i.'" style="display:none;">Agregar Hora de salida:</label>
                <div style="display:flex;">
                    <input id="desc'.$i. '" name="descripcion" type="text"   style="width: 7em;margin-top: -5px;border-radius: 0.3rem;box-shadow: 0px 1px 3px black; display:none;" placeholder="descripcion" onkeyup="return str_staticlengthstyle(event,this,'."'hora_f$i'".'); ">
                    <div id="ico_save'.$i. '" style="display:none;" onclick="saveDescripcion('."'../$clave'".','."'$path'".','."'$i'".')">
                        <img class="pointico" title="Añadir Hora de salida" src="images/guardar.png" height="25px">
                    </div>
                </div>
            </div>';
        ?>

        <?php
            // echo $arc;
    $i++;   
    }  
}


    break;

    case 'del_file':
        $dir=$_POST["file"];
        // $ruta_actual=$_POST["ruta_actual"];
        // $res= unlink($dir);
  //      $res2= rmdir($dir);

        rmdir_recursive($dir);

        break;

    case 'back_ruta':
        // $usuario=$_POST["usuario"];
        // $curso=$_POST["curso"];
        // $back_url=$_POST["back_url"];
        $f_ruta_actual=$_POST["f_ruta_actual"];

        // // $usuario="carpeta_virtual/".$usuario;
        // echo "n".$f_ruta_actual;
        // echo strlen($f_ruta_actual);
        
$ruta="";
        for ($i=0; $i < count(explode("/",$f_ruta_actual))-1; $i++) { 
            $ruta.=explode("/",$f_ruta_actual)[$i]."/";
        }
        $ruta = substr($ruta, 0, -1);

        echo $ruta;
        // echo strlen($ruta);



        break;
        


}
