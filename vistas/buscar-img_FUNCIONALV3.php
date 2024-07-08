<div class="card-box mb-30" >
                        <div class="w10" style="text-align: -webkit-center;">
                            <img src="images/volver.jpg"
                             id="imgVolver" 
                             style="cursor:pointer;height: 25px;
                                    vertical-align: middle;
                                    margin-top: 8px; display: none;" 
                             onclick="back()"></div>

    <input type="hidden" name="" id="f_ruta_actual" value="<?php echo "capture/".$user_name; ?> " style="width: 100%;">
    <!-- <button>Volver</button> -->
</div>
<div class="card-box mb-30" >
    <div class="pd-20" id="contImg" >
    </div>
    <div class="pb-20" id="contRut">
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort">N°</th>
                    
                    <th>Nombre</th>
                   
                    <th class="datatable-nosort">Accion</th>
                </tr>
            </thead>
            <tbody  id="contRutTable">

                <?php 
                    $path="capture/".$user_name;
                    $cant=0;



                    foreach(scandir($path) as $dir ){
                        if($dir !="." && $dir !=".." && is_dir($path."/".$dir)){ 
                            $cant++; 
                ?>
                <tr>

                    <td class="table-plus"><?php echo $cant ?></td>
                    
                    <td class="cont_union"> <img class="pointico" src="images/carpeta.png" height="35px" onclick="showRuta('<?php echo $path."/".$dir; ?>','<?php echo $curso; ?>')"><p onclick="showRuta('<?php echo $path."/".$dir; ?>','<?php echo $curso; ?>')" class="pointico p"><?php echo $dir ?><p></td>
                   
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="#" onclick="eliminar(event,this,'EditPass',<?php echo $img['id'] ?>,'<?php echo $img['user_name'] ?>','<?php echo $img['name_rol'] ?>')"><i class="dw dw-edit2"></i> Eliminar</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php   }
                    } ?>
            </tbody>
        </table>
    </div>
</div>



<script>

    function showRuta(ruta,raiz=""){
// alert(ruta);

        // var user_name = "<?php echo $user_name; ?>" ;
        
        // if(recagar==""){
        //     var back_url=$("#f_ruta_actual").val();
        // }else{
        //     var back_url=$("#back_url").val();
        // }
        // var usuario=$("#f_usuario").val();
        // var usucod=$("#usucod").val();
        // usuario=usucod;

        // alert("ver_ruta--> ruta= "+ruta+", back_url= "+back_url+", usuario= "+usuario);


       // $(".file_cont").html("Cargando...");

cuenta = 0;

posicion = ruta.indexOf("/");
// alert(ruta);
while ( posicion != -1 ) {
   cuenta++;
   posicion = ruta.indexOf("/",posicion+1);
}
// alert(cuenta);


                if(cuenta==1){
                    $("#imgVolver").css({"display":"none"});
                }else{
                    $("#imgVolver").css({"display":"block"});
                }

        $.ajax({
            type: "POST",
            url: "consultarAJAX/ajaxShowImg.php",
            // data: 'funcion1=ver_ruta&ruta_actual='+ruta+'&back_url='+back_url+"&usuario="+usuario,
            data: 'acc=showImg&ruta_actual='+ruta+'&back_url='+cuenta,
            success: function (msg) {


// alert(msg);
                // showView(event,this,'showImg');

                // 
                // 
                // alert(msg);
                $("#contRut").css({"display":"block"});


                
                $("#contImg").html("");
                $("#contRutTable").html(msg);
                $("#f_ruta_actual").val(ruta);
                // rutaReflejo($("#f_ruta_actual").val());
            }
        });
    }


    function showImg(ruta,recagar=""){
// alert(ruta);
        $.ajax({
            type: "POST",
            url: "consultarAJAX/ajaxShowImg.php",
            // data: 'funcion1=ver_ruta&ruta_actual='+ruta+'&back_url='+back_url+"&usuario="+usuario,
            data: 'acc=showImg&ruta_actual='+ruta,
            success: function (msg) {
                // showView(event,this,'showImg');

                $("#contRut").css({"display":"none"});
                
                $("#contImg").html(msg);
                $("#contRutTable").html("");
                $("#f_ruta_actual").val(ruta);
            }
        });
    }

    function eliminar(file,ruta){
        // alert(file);
        // alert(ruta);

    // if (!file.type.match('image.*')) {
    //         alert("yes img");

    //     }else{ 
    //         alert("no img");
    //     } 


        $.ajax({
            type: "POST",
            url: "consultarAJAX/ajaxShowImg.php",
            data: 'acc=del_file&file='+file,
            success: function (msg) {
cuenta = 0;

posicion = ruta.indexOf(".jpg");
while ( posicion != -1 ) {
   cuenta++;
   posicion = ruta.indexOf(".jpg",posicion+1);
}       

if(msg==1 || msg==2){
    eliminarPathImgBD(file);
}
// alert(msg);
           
if(cuenta>0){
    showImg(ruta);
}else{
    showRuta(ruta);
}
        // showImg(ruta);
        // 

                // ver_ruta($("#f_ruta_actual").val(),"recagar");
                // ver_archivos(file);
                // alert(msg);
                // console.log(msg);
               // $(".file_cont").html(msg+"xxxxxxxxxx");
                // $("#rutaReflejo").val($("#f_ruta_actual").val());
                // $("#rutaReflejo").val($("#f_ruta_actual").val());
                // rutaReflejo($("#f_ruta_actual").val());
            }
        });
    }


    function eliminarPathImgBD(file){
        alert(file);
        $.ajax({
            type: "POST",
            url: "consultarAJAX/ajaxFunction.php",
            data: 'funcion1=eliminarPathImgBD&file='+file,
            success: function (msg) {


                if(msg==1){
                    alert(msg);
                    alert("La img se eliminó correctamente");
                }else if(msg==0){

                    alert(msg);

                    alert("Fallo el delete en BD");
                }
                // if(msg==1){
                //     alert("Modificacion exitosa");
                //     showImg(ruta_dir);
                // }else{
                //     showRuta(ruta_dir);
                // }
            }

        });
    }


    function back(){
        // var usuario=$("#f_usuario").val();
        // var back_url=$("#back_url").val();
        var f_ruta_actual=$("#f_ruta_actual").val();

                // alert(f_ruta_actual);

// var usucod=$("#usucod").val();
        // usuario=usucod;
        // alert("back--> usuario= "+usuario+", back_url= "+back_url+", f_ruta_actual= "+f_ruta_actual);

        // if(!back_url){return;}
        
        $.ajax({
            type: "POST",
            url: "consultarAJAX/ajaxShowImg.php",
            data: 'acc=back_ruta&f_ruta_actual='+f_ruta_actual,
            success: function (msg) {

// cuenta = 0;
// posicion = msg.indexOf("/");
// while ( posicion != -1 ) {
//    cuenta++;
   // posicion = msg.indexOf("/",posicion+1);
// }
//                 if(cuenta==1){
//                     $("#imgVolver").css({"display":"none"});
                
//                 }
                // alert(msg);

// alert(cuenta);



                showRuta(msg);

                $("#f_ruta_actual").val(msg);


                // alert(msg.length+msg);
                // $(".file_cont").html(msg);
                // $("#rutaReflejo").val($("#f_ruta_actual").val());
                // rutaReflejo($("#f_ruta_actual").val());
            }
        });
    }

    function agregarHoraDeSalida(ruta_file,ruta_dir,id){
        // alert(ruta_file);
        // alert(ruta_dir);
        // alert(id);
        // 


        $.ajax({
            type: "POST",
            url: "consultarAJAX/ajaxFunction.php",
            data: 'funcion1=buscar_horaf&ruta_file='+ruta_file,
            success: function (msg) {
                // alert(msg);
                // alert(id);
        $("#ico_save"+id).css({"display":"block","margin-top":"-0.2em", "margin-left":"0.5em"});

        $("#titleHF"+id).css({"display":"block", "font-size":"0.9em"});
        $("#hora_f"+id).css({"display":"block"});

        $(".classIcoEditHF").css({"display":"none"});
        $("#idIcoEditHF"+id).css({"display":"block"});
                if(msg!=0){
                    $("#hora_f"+id).val(msg);
                }
            }
        });




    }

    function saveHoraDeSalida(ruta_file,ruta_dir,id){

        var hora_f=$("#hora_f"+id).val();

        // alert(ruta_file);


        $.ajax({
            type: "POST",
            url: "consultarAJAX/ajaxFunction.php",
            data: 'funcion1=save_hora_salida&hora_f='+hora_f+"&ruta_file="+ruta_file,
            success: function (msg) {
                if(msg==1){
                    alert("Modificacion exitosa");
                    showImg(ruta_dir);
                }else{
                    alert("Falló modificacion");
                    showRuta(ruta_dir);
                }
            }

        });
    }

</script>