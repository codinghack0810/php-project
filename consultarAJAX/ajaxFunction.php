<?php
session_start();
error_reporting(0);

$iduser = $_SESSION['iduser'];

if ((!isset($iduser)) || ($iduser == 0)) {
  header('Location: ../include/cerrar.php'); // Redirecciona a la pagina de inicio
}



// include("../consultar/conexBD.php"); 
include("../consultar/admin/dataAdmin.php");


$BD = conexion::connect();

//Comprobamos que el valor no venga vacío


if (isset($_POST['funcion1']) && !empty($_POST['funcion1'])) {
  $funcion = $_POST['funcion1'];

  //En función del parámetro que nos llegue ejecutamos una función u otra
  switch ($funcion) {

    case 'editPass':

      $id   = $_POST['id'];
      $nameUser   = $_POST['nameUser'];
      $mailUser   = $_POST['mailUser'];
      $newPassword   = $_POST['newPassword'];


      $hash = password_hash($newPassword, PASSWORD_DEFAULT);

      // $hash = password_hash("2", PASSWORD_DEFAULT);

      // var_dump($hash."<br>");
      // var_dump($newPassword."<br>");
      // var_dump(password_verify($newPassword, $hash));


      $sql = "UPDATE `user` SET `password`='" . $hash . "',`user_name`='" . $nameUser . "',`user_mail`='" . $mailUser . "' WHERE `id`='" . $id . "' ";
      // echo  $sql;

      $resultado = mysqli_query($BD, $sql) or die("Algo ha ido mal en la consulta a la base de datos");
      // $resultado = $this->mysqli->query($sql);



      if ($resultado) {
        // $messages[] = "Los datos han sido procesados exitosamente.";
        $messages = 1;
      } else {
        // $messages[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo. ".mysqli_error($con);
        $messages = 0;
      }

      echo  $messages;
      break;

    case 'editActive':

      $table   = $_POST['table'];
      $active   = $_POST['active'];
      $id   = $_POST['id'];

      $sql = "UPDATE `" . $table . "` SET `active`='" . $active . "' WHERE `id`='" . $id . "' ";
      // echo  $sql;

      $resultado = mysqli_query($BD, $sql) or die("Algo ha ido mal en la consulta a la base de datos");
      // $resultado = $this->mysqli->query($sql);

      if ($resultado) {
        // $messages = "Los datos han sido procesados exitosamente.";
        // $result= new dataAdmin();
        include("../consultar/admin/dataAdmin.php");

        $resulUser = dataAdmin::allUser();
        // $resulUser= dataAdmin::allUser();   
        dataAdmin::tableUser($resulUser);

        //     // $resulUser=$result-> allUser();  
        // $messages= $resulUser;

        // echo "string";
      } else {
        $messages = "Lo sentimos , el sql falló. Por favor, regrese y vuelva a intentarlo. " . mysqli_error($con);
      }

      echo  $messages;
      break;

    case 'insertUser':

      $id_rol   = $_POST['id_rol'];
      $user_name = $_POST['user_name'];
      $user_mail = $_POST['user_mail'];
      $password = $_POST['password'];

      $hash = password_hash($password, PASSWORD_DEFAULT, [15]);

      $sql = "SELECT user_name FROM user WHERE user_name='" . $user_name . "'";
      $res = mysqli_query($BD, $sql);

      // var_dump($sql."<br><br>");
      // var_dump(mysqli_num_rows($res));
      // exit();

      if (mysqli_num_rows($res) > 0) {
        // $messages[] = "YA EXISTE.";
        $messages = 2;
      } else {

        $sql = " INSERT INTO `user` (`id_rol`,`user_name`,`user_mail`,`password`,`create_date`,`modification_date`,`active`)values('" . $id_rol . "', '" . $user_name . "','" . $user_mail . "','" . $hash . "',localtimestamp,localtimestamp,'1') ";

        $resultado = mysqli_query($BD, $sql);
        // or die ( "Algo ha ido mal en la consulta a la base de datos");
        // $resultado = $this->mysqli->query($sql);

        if ($resultado) {
          // $messages[] = "Los datos han sido procesados exitosamente.";
          $messages = 1;
        } else {
          // $messages[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo. ".mysqli_error($con);
          $messages = 0;
        }
      }



      //  $tee= $a->insertUser($_POST['full_name1'],$_POST['email1'],$_POST['id_usergroup1'],$_POST['user_name1'],$_POST['password1']);




      echo  $messages;
      break;

    case 'buscar_horaf':
      $ruta_file = $_POST["ruta_file"];

      $sql = "SELECT `hora_f` FROM `path` WHERE `path`='" . $ruta_file . "' ";
      $res = mysqli_query($BD, $sql);

      // var_dump($sql."<br><br>");
      // var_dump(mysqli_num_rows($res));
      // exit();

      if (mysqli_num_rows($res) > 0) {
        // $messages[] = "YA EXISTE.";
        $result = mysqli_fetch_array($res);
        $messages = $result["hora_f"];
        // $messages= 2;
      } else {
        $messages = 0;
      }

      echo  $messages;
      break;

    case 'buscar_descripcion':
      $ruta_file = $_POST["ruta_file"];

      $sql = "SELECT `description` FROM `path` WHERE `path`='" . $ruta_file . "' ";
      $res = mysqli_query($BD, $sql);

      // var_dump($sql."<br><br>");
      // var_dump(mysqli_num_rows($res));
      // exit();

      if (mysqli_num_rows($res) > 0) {
        // $messages[] = "YA EXISTE.";
        $result = mysqli_fetch_array($res);
        $messages = $result["description"];
        // $messages= 2;
      } else {
        $messages = 0;
      }

      echo  $messages;
      break;

    case 'save_hora_salida':

      $hora_f = $_POST["hora_f"];
      $ruta_file = $_POST["ruta_file"];

      $sql = "UPDATE `path` SET `hora_f`='" . $hora_f . "' WHERE `path`='" . $ruta_file . "' ";
      // echo  $sql;

      $resultado = mysqli_query($BD, $sql) or die("Algo ha ido mal en la consulta a la base de datos");
      // $resultado = $this->mysqli->query($sql);



      if (mysqli_num_rows($resultado) > 0) {
        // $messages[] = "Los datos han sido procesados exitosamente.";
        $messages = 1;
      } else {
        // $messages[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo. ".mysqli_error($con);
        $messages = 0;
      }

      echo  $messages;
      break;

    case 'save_descripcion':

      $description = $_POST["description"];
      $ruta_file = $_POST["ruta_file"];

      $sql = "UPDATE `path` SET `description`='" . $description . "' WHERE `path`='" . $ruta_file . "' ";
      // echo  $sql;

      $resultado = mysqli_query($BD, $sql) or die("Algo ha ido mal en la consulta a la base de datos");
      // $resultado = $this->mysqli->query($sql);



      if (mysqli_num_rows($resultado) > 0) {
        // $messages[] = "Los datos han sido procesados exitosamente.";
        $messages = 1;
      } else {
        // $messages[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo. ".mysqli_error($con);
        $messages = 0;
      }

      echo  $messages;
      break;

    case 'eliminarPathImgBD':

      $file = $_POST["file"];
      // $ruta_file=$_POST["ruta_file"];

      $sql = "DELETE FROM `path` WHERE `path`='" . $file . "' ";
      // echo  $sql;
      $resultado = mysqli_query($BD, $sql);
      // or die ( "Algo ha ido mal en la consulta a la base de datos");
      // $resultado = $this->mysqli->query($sql);

      if (mysqli_num_rows($resultado) > 0) {
        // if ($resultado) {
        // $messages[] = "Los datos han sido procesados exitosamente.";
        $messages = 1;
      } else {
        // $messages[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo. ".mysqli_error($con);
        $messages = 0;
      }

      echo  $messages;
      break;

    case 'deleteTODASPathBD':

      $path = $_POST['ruta'];

      $sql = "DELETE FROM `path` WHERE `path` LIKE '%" . $path . "%' ";
      $resultado = mysqli_query($BD, $sql);

      //echo $sql;

      if (mysqli_num_rows($resultado) > 0) {
        // $messages[] = "Los datos han sido procesados exitosamente.";
        $messages = 1;
      } else {
        // $messages[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo. ".mysqli_error($con);
        $messages = 0;
      }

      echo  $messages;

      // foreach(scandir($path) as $dirr ){

      //     if($dirr !="." && $dirr !=".." && is_dir("../".$path."/".$dirr)){ 
      //         echo $dirr;
      //     }
      // }

      break;


    case 'eliminarMes':

      $mes = $_POST['dato'];

      $sql = "DELETE FROM `path` WHERE  (SELECT (extract(month from `registre_date`)) as mes ) = " . $mes . " ";
      $resultado = mysqli_query($BD, $sql);

      //echo $sql;

      if (mysqli_num_rows($resultado) > 0) {
        // $messages[] = "Los datos han sido procesados exitosamente.";
        $messages = 1;
      } else {
        // $messages[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo. ".mysqli_error($con);
        $messages = 0;
      }

      echo  $messages;
      break;
  }
} else {
  return "error";
}
