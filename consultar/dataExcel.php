<?php
include('conexBD.php');

// chdir(dirname(__FILE__));


    // $result= mysqli_fetch_array($resultado); 
    // $result= mysqli_fetch_assoc($resultado); 

         // while( $fila = $resultado->fetch_assoc() ){
         //     $data[] = $fila;

         // }    
    // $data=$result[0];
    // var_dump($result);
    // 
    // $data =  array();
    //         while ($columna = mysqli_fetch_assoc( $resultado )){
    //         // mysqli_fetch_assoc == mysqli_fetch_array
    //         // assoc = los mismos datos pero sin repetirlos         
    //             $data[]=$columna;
    //         }       
    //         // return $array; 
    // var_dump($data);
class dataExcel  {
// class dataAdmin {


   function allExcel(){
    $sql = "SELECT COUNT(id), create_date FROM path WHERE name_cliente='GENEX' GROUP BY create_date"; 

    // $resultado = mysqli_query( $conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    $resultado = $this->mysqli->query($sql);
    while ($columna = mysqli_fetch_assoc( $resultado )){
        $data[]=$columna;
            }       

    // $result= mysqli_fetch_assoc($resultado); 
    // $data=$result[0];
             // return $data;
    
         if (isset($data)) {
             return $data;
         }
  }
    function dataExcell($name_cliente,$create_date){

        $sql = "SELECT path FROM path WHERE name_cliente='".$name_cliente."' AND create_date='".$create_date."'"; 


        $resultado = $this->mysqli->query($sql);
        while ($columna = mysqli_fetch_assoc( $resultado )){
            $data[]=$columna;
        }       
        
        if (isset($data)) {
            return $data;
        }
  }


    function arrAllPathAndDataOfImgCliente($name_cliente,$create_date){

$BD= conexion::connect();
        $sql = "SELECT p.path, p.hora, u.user_name as monitorista FROM `path` p, `user` u WHERE p.name_cliente='".$name_cliente."' AND p.create_date='".$create_date."' AND p.id_monitor=u.id ORDER BY p.hora"; 


        // $resultado = $BD->query($sql);
           $resultado = mysqli_query( $BD, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");

        while ($columna = mysqli_fetch_assoc( $resultado )){
            $data[]=$columna;
        }       
        
        if (isset($data)) {
            return $data;
        }
            return $sql;

  }
}
?>