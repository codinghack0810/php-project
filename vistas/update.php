<?php
session_start();
error_reporting(0);

include("../consultar/conexBD.php"); 

$BD= conexion::connect();

$iduser=$_SESSION['iduser'];

$sql="SELECT id,user_name FROM user ";
$sql="SELECT id,name_cliente FROM path";
$res = mysqli_query( $BD, $sql );
// var_dump($res);

// $result= mysqli_fetch_assoc($res);
        while ($columna = mysqli_fetch_assoc( $res )){

                // Eliminar los espacios vacios del nombre
                $buscarC = " ";
                $replasarC = "";
                $string = $columna['name_cliente'];
                $idPath = $columna['id'];
                $salida = str_replace($buscarC, $replasarC, $string); 
// $BD= conexion::connect();
                $sqll="SELECT id FROM user where user_name='".$salida."'";
        		$ress = mysqli_query( $BD, $sqll );
// var_dump(mysqli_num_rows($ress));
// echo "<br>";

                if (mysqli_num_rows($ress)>0) {


                	$d = mysqli_fetch_assoc( $ress );
// var_dump($d);
// echo "<br>";
// echo "<br>";


                	// $sql="UPDATE path pp SET pp.id_cliente=(SELECT u.id from user u, path p where u.user_name=$salida and p.id=".$d['id'].")";
                	$sql="UPDATE path pp SET pp.id_cliente=".$d['id']." WHERE pp.id=".$idPath."";
                	$resss = mysqli_query( $BD, $sql );

var_dump($sql);
var_dump($resss);
// var_dump(mysqli_num_rows($resss));
echo "<br>";
echo "<br>";

                }

        	

        		// $res = mysqli_query( $BD, $sql );

            // $data[]=$columna;
        }   

// var_dump($data);




?>