<?php 
session_start();
error_reporting(0);

date_default_timezone_set('America/Mexico_City');
// date_default_timezone_set('America/La_Paz'); //VENEZUELA
setlocale(LC_TIME, 'spanish');

// echo date('d/m/y H:i:s A'); echo "<br>";
// echo strftime("%d/%m/%y y son las %H:%M");
// include("consultar/conexBD.php"); 
// $BD= conexion::connect();
// include("consultar/admin/dataAdmin.php"); 


$rol=$_SESSION['name_rol'];
$user_name=$_SESSION['user_name'];
$iduser=$_SESSION['iduser'];
$respSQLinsertImg=$_GET['LI'];


if(!isset($iduser)){
  // var_dump("entro");
// mysqli_close($con); // Cerrando la conexion

header('Location: include/cerrar.php'); // Redirecciona a la pagina de inicio
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- <link rel="shortcut icon" href="logo.png">  -->
  <link rel="stylesheet" type="text/css" href="css/mystyle.css">
  <link rel="stylesheet" type="text/css" href="icons/fonts.css">


  <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
  <!-- <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css"> -->
  <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">


<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> -->

  <title></title>
</head>

<body>

<h3 id="Bienv"> Bienvenido: <?php echo $user_name; ?></h3>
<a href="include/cerrar.php" id="Cs">Cerrar Sesión</a>

<?php include_once ("include/menu.php");?>

<div class="main-container" id="main-container">

  <div id="inicio" class="View" >
    <img src="images/lanred.jpg" style="box-shadow: #070708 0px 1px 14px 0px; width: 350px; height: 150px;  border-radius: 0.5rem; " class="w3-round">
  </div>


  <div id="UploadImg" class="View" style="display: none;">
    <?php //include_once ("vistas/preview-multi-imgwithcss.php");?>
  </div>
  <div id="SearchImg" class="View" style="display: none;">
     <?php //include_once ("vistas/buscar-img.php");?> 
  </div>

  <div id="SearchExcel" class="View"  style="display: none;">
    <?php //include_once ("vistas/buscar-excel.php");?>
  </div>

<!--  -->

  <div id="NewUser" class="View" style="display: none;">
    <?php include_once ("vistas/registrar-usuarios.php");?>
  </div>
  <div id="SearchUser" class="View" style="display: none; height: 85%;">
    <?php include_once ("vistas/buscar-usuarios.php");?>
  </div>
  <div id="EditPass" class="View" style="display: none;">
    <?php include_once ("vistas/editar-usuarios.php");?>
  </div>
  <!-- <div  class="View" > -->
    <!-- <h3>sdd</h3> -->
    <!-- <?php //include_once ("vistas/update.php");?> -->
  <!-- </div> -->
  
</div>





 

  







<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/blockVistas.js"></script>
<script src="js/validaciones.js"></script>



<!--    js -->
  <script src="vendors/scripts/core.js"></script>
  <script src="vendors/scripts/script.min.js"></script>
  <script src="vendors/scripts/process.js"></script>
  <script src="vendors/scripts/layout-settings.js"></script>
  <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
  <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
  <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
  <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
  <!-- buttons for Export datatable -->
  <script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
  <!-- <script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script> -->
  <script src="src/plugins/datatables/js/buttons.print.min.js"></script>
  <script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
  <script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
  <!-- <script src="src/plugins/datatables/js/pdfmake.min.js"></script> -->
  <script src="src/plugins/datatables/js/vfs_fonts.js"></script>
  <!-- Datatable Setting js -->
  <!-- <script src="vendors/scripts/datatable-setting.js"></script> -->

<script type="text/javascript">

$(document).ready(function(){
  var respSQLinsertImg = "<?php echo $respSQLinsertImg; ?>" ;
  var rediret = document.getElementById("redirect");
  var valRediret = rediret.value;

// alert(valRediret);

  if(respSQLinsertImg!="" && valRediret!="entro"){
    document.getElementById("UploadImg").style.display = "block";
    document.getElementById("inicio").style.display = "none";
    rediret.value = "entro";
// alert(rediret.value);
  }

  //   // alert(document.getElementById("files1").value);
  //   // alert(saveNewImg);

  //   // document.getElementById("files1").value= "";
  
  // // if(saveNewImg!="" && saveNewImg=="Guardar Imagenes"){
  // //   alert(document.getElementById("files1").value);
  // //   // document.getElementById("files1").value= "";
  // //   alert(document.getElementById("files1").value);
  // // }
  //       var height = $(window).height();

  //     $('#main-container').height(height);
     // alert('status'); 
});


// $(document).ready(function(){


// });
</script>

</body>
</html>
