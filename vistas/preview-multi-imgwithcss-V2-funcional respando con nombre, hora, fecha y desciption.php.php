<?php
    session_start();
    error_reporting(0);

    $arrayUpC = $_FILES['uploadCapt'];
// var_dump($arrayUpC);
    
?>

<form method='POST' action='consultarAJAX/ajaxSaveImg.php' enctype='multipart/form-data'>

<input type="hidden" name="user_name_dir" value="<?php echo $user_name;?>">

<input type="file" id="files1" name="uploadCapt[]" multiple="true" />
<br/>
<input type='submit' class='buttonimg' value='Guardar Imagenes' name='saveNewImg' >

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
                // alert();

                let arr = theFile.name.split('-'); 


              // Insertamos la imagen
                var respaldo=document.getElementById("lista_imagenes").innerHTML;

                document.getElementById("lista_imagenes").innerHTML = respaldo+['<div style="border-radius: 0rem 0rem 0.5rem 0.5rem; float: left;">                                                                                         <img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>                                                               <p style="margin-bottom: auto;"><b>',arr[0],'</b></p>                                                                                         <div style="width: 100%;height: 1.5rem;display: flex;">                                                                                                  <p>Hora:',arr[1],'</p>                                                                                                                           <h3 style="margin-left: 0.5rem;"></h3>                                                                                             </div>                                                                     <div style="width: 100%;height: 2rem;display: flex;">                                                                                                    <p>Fecha:',arr[2],'</p>                                                                                                                                       <h3 style="margin-left: 0.5rem;"></h3>                                                                                           </div><div> <p>Descripcion</p> <input type="text" name="description[]"></div>                                                                                                                                                                                                                             </div>'].join('');
            };
        })(f);

        reader.readAsDataURL(f);
      }
  }

  document.getElementById('files1').addEventListener('change', archivo, true);
</script>
