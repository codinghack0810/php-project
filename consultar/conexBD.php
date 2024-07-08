<?php
session_start();
error_reporting(0);
?>

<?php
class conexion
{

    function connect()
    {

        // Ejemplo de conexión a base de datos MySQL con PHP.


        // // Datos de la base de datos local
        // $usuario = "root";
        // $password = "";
        // $servidor = "localhost";
        // $nameBD = "lanredmx_sc";  



        // FALSOOOO!
        // $usuario = "lanredmx_wp285";
        // $usuario = "lanredmx@localhost";      
        // $password = "";
        // $servidor = "psmvertickal.com";
        // $servidor = "ftp.lanred.mx";

        // CORRECTO
        $usuario = "root";
        $password = "";
        $servidor = "localhost";
        $nameBD = "lanred_sc";


        // creación de la conexión a la base de datos con mysql_connect()
        $BD = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al servidor de Base de datos");

        // Selección del a base de datos a utilizar
        $db = mysqli_select_db($BD, $nameBD) or die("Upps! Pues va a ser que no se ha podido conectar a la base de datos");


        // Fin de la tabla
        // cerrar conexión de base de datos
        //mysqli_close( $conexion );
        return $BD;
    }
}
?>

