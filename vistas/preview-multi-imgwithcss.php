<?php
    session_start();
    error_reporting(0);

    $arrayUpC = $_FILES['uploadCapt'];
// var_dump($arrayUpC);
// fecha actual
$dateNow= date('d_M_Y');    
// $dateFormato= date('Y_m_d');    
$ano= date('Y');    
$mes= date('m');    
$dia= date('d');    
?>

<form method='POST' action='consultarAJAX/ajaxSaveImg.php' enctype='multipart/form-data'>

<input type="hidden" name="user_name_dir" value="<?php echo $user_name;?>">

<input type="file" id="files1" name="uploadCapt[]" multiple="true" onclick="barrido();" />
<br/>
<input type='submit' class='buttonimg' value='Guardar Imagenes' name='saveNewImg' >


<!-- <div id="respSQLinsertImg" style="display: none;"> 
   <?= $respSQLinsertImg ?> 
</div> -->

<div id="lista_imagenes"><?php echo $respSQLinsertImg; ?></div>
<input type="hidden" name="" id="redirect">


  
</form>

<script>



// function barrido(){
//     document.getElementById("lista_imagenes").innerHTML="";
// }



// $(document).ready(function(){
//   // var saveNewImg = "<?php echo $saveNewImg; ?>" ;
//   //   // alert(document.getElementById("files1").value);
//   //   // alert(saveNewImg);

//   //   // document.getElementById("files1").value= "";
  
//   // // if(saveNewImg!="" && saveNewImg=="Guardar Imagenes"){
//   // //   alert(document.getElementById("files1").value);
//   // //   // document.getElementById("files1").value= "";
//   // //   alert(document.getElementById("files1").value);
//   // // }
//   //       var height = $(window).height();

//   //     $('#main-container').height(height);
//      alert('status'); 
// });


function archivo(evt) {
    var dateNow = "<?php echo $dateNow; ?>" ;
    var dateFormato = "<?php echo $dateFormato; ?>" ;
    var ano = "<?php echo $ano; ?>" ;
    var mes = "<?php echo $mes; ?>" ;
    var dia = "<?php echo $dia; ?>" ;
    document.getElementById("lista_imagenes").innerHTML="";


     // alert(dateFormato);

    var files = evt.target.files; // FileList object
      // Obtenemos la imagen del campo "file".
    for (var i = 0, f; f = files[i]; i++) {
        // let j = 0; 
        let arCliente = ""; 
        let arCamara = ""; 
        let arAno = ""; 
        let arMes = ""; 
        let arDia = ""; 
        let arHora = ""; 
        let arMin = ""; 
        let arSeg = ""; 
 
//---------------mantenimiento Nov-22 Genesis amaiz----------------------
        let arNameOriginal = ""; 
//-----------------------------------------------------------------------




        //Solo admitimos imágenes.
        if (!f.type.match('image.*')) {
            continue;
        }
        // else{
        //   alert("El archivo debe ser jpg,png,etc");
        // }

        var reader = new FileReader();

        reader.onload = (function(theFile) {
            return function(e) {


//---------------mantenimiento Dic Genesis amaiz----------------------
                arNameOriginal=theFile.name;
//-----------------------------------------------------------------------
                // console.log(e.target.result);
                // alert();
                // console.log(theFile.name);
                // console.log(theFile);

                let arr = theFile.name.split('_'); 
                // arr= nombre-empresa_nombre-camara_años_mes_dia_hora_min_seg
                // key->     0               1        2    3   4   5    6   7

             // alert(theFile.name);
             // alert(arr);


        // var z=1;
        for (var j = 1; j <= arr.length; j++) {


            if(j==1){
                arCliente=arr[j-1];
                // alert("arCliente: "+arCliente);
            }else if(j==arr.length){
                arSeg=arr[j-1].replace('.jpg', '');
                // alert("arSeg: "+arSeg);
            }else if(j==arr.length-1){
                arMin=arr[j-1];
                // alert("arMin: "+arMin);
            }else if(j==arr.length-2){
                arHora=arr[j-1];
                // alert("arHora: "+arHora);
            }else if(j==arr.length-3){
                arDia=arr[j-1];
                // alert("arDia: "+arDia);
            }else if(j==arr.length-4){
                arMes=arr[j-1];
                // alert("arMes: "+arMes);
            // }else if(j==arr.length-5 && arr[j]==ano){
            }else if(j==arr.length-5){
                arAno=arr[j-1];
                // alert("ano: "+ano);
                // alert("arAno: "+arAno);
            }else{
                arCamara+=arr[j-1];
                // alert("arCamara: "+arCamara);
            }           
        }

     // alert(arr.length);
     // alert(typeof(arr[3]));


//---------------mantenimiento Dic 7 Genesis amaiz----------------------

// ---- OTRO FORMATO----
// formato A de la camara 
// NOMBRE EMPRESA_  nombre_camara_  añosmesdiahoraminseg_ @N°.jpg



// para verificar si es de este tipo de formato buscamos el @ con pop y includes
var ultimoObjArr = arr.pop();
// alert(ultimoObjArr);

if(ultimoObjArr.includes('@')){
        
    // const findIndexMain = (element) => element == 'main';
    // const findIndexMain = (element) => element == '@';
    const findIndexMain = (element) => element == arr[arr.length-1];
    // alert(arr[arr.length-1]);

    var indexMain = arr.findIndex(findIndexMain);
    // alert(indexMain);

    // arr2.splice(indexMain+1,2);

    for (var j = 0; j <= arr.length; j++) {

        if(j>0 && j<=indexMain-1){
            // alert("arCamara: "+arr[j]);
            // arCamara +=theFile.name.replace(arr[0], "");
            //arCamara += arr[j]+" ";
            arCamara += arr[j];
        }else if(j== indexMain){
            
            // alert("date: "+arr[j]);
             arAno= arr[j].substr(0,4);
             // alert("arAno: "+arr[3].substr(0,4));
             
             arMes= arr[j].substr(4,2);
             // alert("arMes: "+arr[3].substr(4,2));
             // 
             arDia= arr[j].substr(6,2);
             // alert("arDia: "+arr[3].substr(6,2));
             // 
             arHora= arr[j].substr(8,2);
             // alert("arHora: "+arr[3].substr(8,2));
             // 
             arMin= arr[j].substr(10,2);
             // alert("arMin: "+arr[3].substr(10,2));
             // 
             arSeg= arr[j].substr(12,2);
             // alert("arSeg: "+arr[3].substr(12,2));
        }

    }
    //alert(arr); 
    // arCamara=arCamara.replace(arr[4], "");
}
     

//-------------------------------------------------------------------







              // Insertamos la imagen
                var respaldo=document.getElementById("lista_imagenes").innerHTML;
 // document.getElementById("lista_imagenes").innerHTML = respaldo+['<div
                document.getElementById("lista_imagenes").innerHTML = respaldo+['<div style="border-radius: 0rem 0rem 0.5rem 0.5rem; float: left;">                                                                                         <img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>                                                               <p style="margin-bottom: auto;"><b>Cliente: ',arCliente,'</b></p>                                                                                           <div style="width: 100%;height: 1.5rem;display: flex;">                                                                                                  <p>Camara: ',arCamara,'</p>                                                                                                                           <h3 style="margin-left: 0.5rem;"></h3>                                                                                             </div>                                                                                         <div style="width: 100%;height: 1.5rem;display: flex;">                                                                                                  <p>Hora: ',arHora,':',arMin,':',arSeg,'</p>                                                                                                                           <h3 style="margin-left: 0.5rem;"></h3>                                                                                             </div>                                                                     <div style="width: 100%;height: 2rem;display: flex;">                                                                                                    <p>Fecha: ',dateNow,'</p>                                                                                                                                       <h3 style="margin-left: 0.5rem;"></h3>                                                                                           </div><div> <p>Descripcion</p> <input type="text" name="description[',theFile.name,']"></div>                                                                                             <input type="hidden" name="arCliente[',theFile.name,']" value="',arCliente,'">                                                                    <input type="hidden" name="arCamara[',theFile.name,']" value="',arCamara,'">                                                                                                                                         <input type="hidden" name="arHora[',theFile.name,']" value="',arHora,'">                                                                                                                                             <input type="hidden" name="arMin[',theFile.name,']" value="',arMin,'">                                                                              <input type="hidden" name="arSeg[',theFile.name,']" value="',arSeg,'">                                                                          <input type="hidden" name="arfechaIMG[',theFile.name,']" value="',arAno,'/',arMes,'/',arDia,'">                                                                        <input type="hidden" name="arNameOriginal[',theFile.name,']" value="',arNameOriginal,'">                                                                                                                                                 </div>'].join('');
            };
        })(f);

        reader.readAsDataURL(f);
    }
}

  document.getElementById('files1').addEventListener('change', archivo, true);
</script>
