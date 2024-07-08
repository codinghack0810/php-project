<?php

    $dir="capture/";
    $arrayUpC = $_FILES['uploadCapt'];
     basename($_FILES['uploadCapt']['name']);
    // print_r($arrayUpC);

$i=0;
      foreach($arrayUpC as $key=>$var){
        if($key=="name"){
          $arrnameCap = $arrayUpC["name"];
          $arrtmp_nameCap = $arrayUpC["tmp_name"];
          // var_dump("arrnamecap --> ".$arrnameCap."<br>");
          // var_dump("var ".$var."<br>");
          // $i++;
    // echo "{$key} => {$var} ";
    // print_r($arrayUpC);
            // var_dump("arrtmp_nameCap --> ".$arrtmp_nameCap."<br>");
// var_dump($arrtmp_nameCap[0]);
    // 
          foreach($arrnameCap as $key){
            $nameCap = $key;
            $dir_capt = $dir.$nameCap;


        if (move_uploaded_file($arrtmp_nameCap[$i], $dir_capt)) {
            echo "El archivo ". $arrnameCap[$i]. " se cargo.";
             echo "<br>"; 
        } else {
            echo "Operacion fallida, hubo un error durante la carga del archivo. ";
        }

            // var_dump("dir_capt --> ".$dir_capt."<br>");
            // var_dump("arrtmp_nameCa$i --> ".$arrtmp_nameCap[$i]."<br>");
            $i++;
          }
        }
        
      }
// var_dump($_FILES["uploadCapt"]);
// var_dump($dir_capt);
// var_dump($arrayUpC);
// var_dump($arrayUpC2);
// var_dump($nameCap);

?>

<form method='POST' action='' enctype='multipart/form-data'>

<input type="file" id="files1" name="uploadCapt[]" multiple="true" />
<br/>
<input type='submit' class='buttonimg' value='Añadir a Galeria' name='nvaimgGaleria'>

<div id="lista_imagenes"></div>


  
</form>

<script>
  function archivo(evt) {
      var files = evt.target.files; // FileList object

      // Obtenemos la imagen del campo "file".
      for (var i = 0, f; f = files[i]; i++) {
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
                // console.log(e.target.result);
                // console.log(theFile);
                // alert();

                        let posCliente=theFile.name.indexOf('-');   
                        let posFecha=theFile.name.indexOf('-',posCliente + 1);   
                        let posHora=theFile.name.indexOf('-',posFecha + 1);   
                        let posNomre=theFile.name.indexOf('-',posHora + 1);   

                console.log(theFile.name);
                console.log(posCliente);
                console.log(posFecha);
                console.log(posHora);
                console.log(posNomre);



        let Cliente = theFile.name.substr(0, (posCliente));  
        let fecha = theFile.name.substr((posCliente+1), posFecha);  
        let Hora = theFile.name.substr(posHora, posFecha);  
        let nombre = theFile.name.substr(posNomre, posHora);  

              // Insertamos la imagen
                var respaldo=document.getElementById("lista_imagenes").innerHTML;

                document.getElementById("lista_imagenes").innerHTML = respaldo+['          <img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>                                                                                                                                       <div class="w3-container w3-white" style="border-radius: 0rem 0rem 0.5rem 0.5rem;">                                                               <p style="margin-bottom: auto;"><b>Nombre Cliente</b></p>                                                                                         <div style="width: 100%;height: 1.5rem;display: flex;">                                                                                                  <p>Hora:</p>                                                                                                                           <h3 style="margin-left: 0.5rem;"></h3>                                                                                             </div>                                                                     <div style="width: 100%;height: 2rem;display: flex;">                                                                                                    <p>Fecha: </p>                                                                                                                                       <h3 style="margin-left: 0.5rem;"></h3>                                                                                           </div>                                                                                                                                                <div class="w3-center w3-padding-16">                                                                                                                      <button class="w3-button w3-teal w3-padding-large w3-center w3-hover-black" name="editar"  value="editar" style="background-color: #00c5f7!important; font-weight: bold;">Editar</button>                                                                                                                                                </div>                                                                                                                                            </div>'].join('');
            };
        })(f);

        reader.readAsDataURL(f);
      }
  }

  document.getElementById('files1').addEventListener('change', archivo, true);
</script>
