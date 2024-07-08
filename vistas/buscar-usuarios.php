<?php 
    include ("consultar/admin/dataAdmin.php");
    $result= new dataAdmin();
    $resulUser=$result-> allUser();
    // $Elegir = "Elegir";

?> 
                <!-- Simple Datatable start -->
                <div id="tableUser" style="margin-bottom: 80px;">
<!-- <div class="card-box mb-30">
                    <div class="pd-20">
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">ID</th>
                                    
                                    <th>Usuario</th>
                                   
                                    <th>Perfil</th>
                               
                                    <th>Estado</th>
                                    <th class="datatable-nosort">Accion</th>
                                </tr>
                            </thead>
                            <tbody id="tableUser" > -->
<?php 
    // dataAdmin::tableUser($resulUser);
?>
<!--                             </tbody>
                        </table>
                    </div>
</div> -->
                </div>

<script>



function status(e,field,status,edit="",tableBD=""){


  let funcion1 = "editActive";
  let id = edit;
  let table = tableBD;

  if(status == "desactivar"){
    var active = 0;

  }else if(status == "activar"){
    var active = 1;
  }

// alert(funcion1); 
// alert(table); 
// alert(status); 
// alert(id); 
// alert(active); 

  // $.post("consultarAJAX/ajaxFunction.php", { funcion1:funcion1,table:table,active:active,id:id }, function(data) {
  //             // $("#idstate").html(data);  
  //             alert(data);     
  //       // alert("Mensaje Enviado correctamente ..!!");
  //   });
        $.ajax({
            type: "POST",
            // url: "consultarAJAX/ajaxFunction.php",
            url: "consultar/admin/table.php",
            data: 'funcion1=editActive&table='+table+'&active='+active+'&id='+id,
            success: function (msg) {
                // alert(msg);
                $("#tableUser").html(msg);

                // location.reload();
            }
        });

} 


function eliminarUser(e,field,status,edit=""){


  let funcion1 = "deletUser";
  let id = edit;
// alert(funcion1);
        $.ajax({
            type: "POST",
            // url: "consultarAJAX/ajaxFunction.php",
            url: "consultar/admin/table.php",
            data: 'funcion1=deletUser&id='+id,
            success: function (msg) {
                // alert(msg);
                $("#tableUser").html(msg);

                // location.reload();
            }
        });

} 


</script>