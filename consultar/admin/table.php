<?php 
    include ("dataAdmin.php");
    $result= new dataAdmin();


$BD= conexion::connect();
    // $Elegir = "Elegir";


if(isset($_POST['funcion1']) && !empty($_POST['funcion1'])) {
    $funcion = $_POST['funcion1'];

    //En función del parámetro que nos llegue ejecutamos una función u otra
    switch($funcion) {

        case 'editActive':

            $table   =$_POST['table'];
            $active   =$_POST['active'];
            $id   =$_POST['id'];

            $sql= "UPDATE `".$table."` SET `active`='".$active."' WHERE `id`='".$id."' ";
            // echo  $sql;

            $resultado = mysqli_query( $BD, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            // $resultado = $this->mysqli->query($sql);

                 if ($resultado) {
    $resulUser=$result-> allUser();
    $result-> tableUser($resulUser);
   // dataAdmin::tableUser($resulUser);


                  } else {
                      $messages = "Lo sentimos , el sql falló. Por favor, regrese y vuelva a intentarlo. ".mysqli_error($con);
                  }

            // echo  $messages;
        break;

        case 'refreshTale':

            $resulUser=$result-> allUser();
            $result-> tableUser($resulUser);
            // dataAdmin::tableUser($resulUser);

        break;

        case 'deletUser':

            $id   =$_POST['id'];

            $sql= "DELETE FROM user WHERE id='".$id."'";
            // echo  $sql;

            $resultado = mysqli_query( $BD, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            // $resultado = $this->mysqli->query($sql);

                 if ($resultado) {
    $resulUser=$result-> allUser();
    $result-> tableUser($resulUser);
   // dataAdmin::tableUser($resulUser);


                  } else {
                      $messages = "Lo sentimos , el sql falló. Por favor, regrese y vuelva a intentarlo. ".mysqli_error($con);
                  }

            // echo  $messages;
        break;
    }
}


 
?>

  
           