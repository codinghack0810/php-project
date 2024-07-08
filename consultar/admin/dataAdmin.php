<?php
chdir(dirname(__FILE__));
include('../conexBD.php');



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
class dataAdmin extends conexion
{
    // class dataAdmin {

    public $BD;
    public $data;
    protected $mysqli;


    function __construct()
    {
        $this->mysqli = parent::connect();
        $this->data = array();
    }

    function allRolUser()
    {
        $sql = "SELECT g.id, g.name FROM `rol` g ";

        // $resultado = mysqli_query( $conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        $resultado = $this->mysqli->query($sql);
        while ($columna = mysqli_fetch_assoc($resultado)) {
            $data[] = $columna;
        }

        // $result= mysqli_fetch_assoc($resultado); 
        // $data=$result[0];
        // return $data;

        if (isset($data)) {
            return $data;
        }
    }
    function allUser()
    {
        $sql = "SELECT g.id, g.user_name, g.active, r.name as name_rol FROM `user` g, `rol` r where g.id_rol=r.id  ORDER BY g.user_name ASC ";

        // $resultado = mysqli_query( $conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        $resultado = $this->mysqli->query($sql);
        while ($columna = mysqli_fetch_assoc($resultado)) {
            $data[] = $columna;
        }

        // $result= mysqli_fetch_assoc($resultado); 
        // $data=$result[0];
        // return $data;

        if (isset($data)) {
            return $data;
        }
    }

    function tableUser($resulUser)
    {
        // $resulUser = self::allUser();

        $Elegir = "Elegir";



?>
        <div class="card-box mb-30">
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
                    <tbody>

                        <?php foreach ($resulUser as $img) { ?>
                            <tr>
                                <td class="table-plus"><?php echo $img['id'] ?></td>
                                <!-- <td><?php echo $img['full_name'] ?></td> -->
                                <td><?php echo $img['user_name'] ?></td>
                                <!-- <td><?php echo $img['email'] ?></td> -->
                                <td><?php echo $img['name_rol'] ?></td>
                                <!-- <td><?php echo $img['create_date'] ?></td> -->
                                <td><?php if ($img['active'] == 1) {
                                        echo 'Activo';
                                    } else {
                                        echo 'Inactivo';
                                    }; ?></td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <?php if ($img['active'] == 1) { ?>
                                                <a class="dropdown-item" href="#" onclick="status(event,this,'desactivar',<?php echo $img['id'] ?>,'user')"><i class="dw dw-edit2"></i> Desactivar</a>
                                            <?php } else { ?>
                                                <a class="dropdown-item" href="#" onclick="status(event,this,'activar',<?php echo $img['id'] ?>,'user')"><i class="dw dw-edit2"></i> Activar</a>
                                            <?php }; ?>


                                            <a class="dropdown-item" href="#" onclick="showView(event,this,'EditPass',<?php echo $img['id'] ?>,'<?php echo $img['user_name'] ?>','<?php echo $img['name_rol'] ?>')"><i class="dw dw-edit2"></i> Editar</a>

                                            <a class="dropdown-item" href="#" onclick="eliminarUser(event,this,'deletUser',<?php echo $img['id'] ?>)"><i class="dw dw-edit2"></i> Eliminar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>


                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

<?php

    }

    function allExcel()
    {

        $sql = "SELECT `name_cliente` from `path` GROUP BY `name_cliente`";
        $res = $this->mysqli->query($sql);
        while ($columna = mysqli_fetch_assoc($res)) {
            $arrNameCliente[] = $columna;
        }

        foreach ($arrNameCliente as $key) {

            $data[] = self::excelCliente($key['name_cliente']);
            // $sql = "SELECT COUNT(id), create_date, name_cliente FROM path WHERE name_cliente='".$key['name_cliente']."' GROUP BY create_date"; 
            //    $res = $this->mysqli->query($sql);
            //    while ($columna = mysqli_fetch_assoc( $res )){
            //            $data[]=$columna;
            //    } 
        }

        foreach ($data as $key) {
            $x[] = $key[0];
            // $x[]=$i;

            $i = 0;
            // while($key[$i+1]!=NULL){
            while ($key[$i + 1] != NULL) {
                $i++;
                $x[] = $key[$i];
            }
            // if($key[$i+1]!=NULL){
            //     $i++;
            //     $x[]=$key[$i];
            // }else{
            //     $i=0;
            // }

        }

        return $x;
        // return $data;
        // array(1) { [0]=> array(3) { ["COUNT(id)"]=> string(1) "2" ["create_date"]=> string(11) "02_Mar_2022" ["name_cliente"]=> string(12) "AGUIARYSEIJA" } }

        // array(2) { [0]=> array(3) { ["COUNT(id)"]=> string(1) "3" ["create_date"]=> string(11) "01_Mar_2022" ["name_cliente"]=> string(5) "GENEX" } [1]=> array(3) { ["COUNT(id)"]=> string(1) "1" ["create_date"]=> string(11) "02_Mar_2022" ["name_cliente"]=> string(5) "GENEX" } }



        // // SELECT COUNT(p1.id), p2.create_date, p2.name_cliente 
        // // FROM   (SELECT p1.name_cliente) AS Contacto 
        // //         FROM   path AS p1 
        // //                LEFT JOIN path AS p2 
        // //                       ON p1.create_date = p2.create_date) 
        // // ORDER BY p2.create_date, Contacto;

        //     $sql = "SELECT COUNT(id), create_date, name_cliente FROM path GROUP BY name_cliente ORDER BY create_date;"; 

        //     // $resultado = mysqli_query( $conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        //     $resultado = $this->mysqli->query($sql);
        //     while ($columna = mysqli_fetch_assoc( $resultado )){
        //         $data[]=$columna;
        //             }       

        //     // $result= mysqli_fetch_assoc($resultado); 
        //     // $data=$result[0];
        //              // return $data;

        //          if (isset($data)) {
        //              return $data;
        //          }
    }

    function excelCliente($user_name)
    {
        // $sql = "SELECT COUNT(id), create_date, name_cliente FROM path WHERE name_cliente='".$user_name."' GROUP BY create_date"; 


        //---------------mantenimiento Dic seis Genesis amaiz----------------------
        $user_name = str_replace(' ', '', $user_name);
        //-----------------------------------------------------------------------

        $sql = "SELECT COUNT(id), create_date, name_cliente FROM path WHERE path LIKE '%" . $user_name . "%' GROUP BY create_date";



        //---------------mantenimiento Nov-22 Genesis amaiz----------------------
        $sql = "SELECT COUNT(id), create_date, name_cliente FROM path WHERE path LIKE '%" . $user_name . "%' GROUP BY create_date ORDER by registre_date DESC ";


        // $sql ="SELECT COUNT(id), create_date, name_cliente FROM path WHERE path LIKE '%".$user_name."%' GROUP BY create_date ORDER by registre_date DESC LIMIT 1";
        //-----------------------------------------------------------------------


        // var_dump($sql);
        // echo "<br>";
        // exit();

        // $resultado = mysqli_query( $conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        $resultado = $this->mysqli->query($sql);

        while ($columna = mysqli_fetch_assoc($resultado)) {
            $data[] = $columna;
        }

        // $result= mysqli_fetch_assoc($resultado); 
        // $data=$result[0];
        // return $data;

        if (isset($data)) {
            return $data;
        }
    }

    function dataExcel($name_cliente, $create_date)
    {

        $sql = "SELECT path FROM path WHERE name_cliente='" . $name_cliente . "' AND create_date='" . $create_date . "'";


        $resultado = $this->mysqli->query($sql);
        while ($columna = mysqli_fetch_assoc($resultado)) {
            $data[] = $columna;
        }

        if (isset($data)) {
            return $data;
        }
    }


    function arrAllPathAndDataOfImgCliente($name_cliente, $create_date)
    {

        $sql = "SELECT p.path, p.hora, p.description, u.user_name as monitorista, p.hora_f FROM `path` p, `user` u WHERE p.name_cliente='" . $name_cliente . "' AND p.create_date='" . $create_date . "' AND p.id_monitor=u.id ORDER BY p.hora";

        // $sql = "SELECT p.path, p.hora, p.description, u.user_name as monitorista, p.hora_f FROM `path` p, `user` u WHERE p.create_date='".$create_date."' AND p.id_monitor=u.id AND p.name_cliente LIKE '%".$name_cliente."%' ORDER BY p.hora"; 

        // var_dump($sql);
        // exit();
        $resultado = $this->mysqli->query($sql);
        while ($columna = mysqli_fetch_assoc($resultado)) {
            $data[] = $columna;
        }

        if (isset($data)) {
            return $data;
        }
        // return $sql;

    }


    function pathGroupByMes()
    {

        $sql = "SELECT (extract(month from `registre_date`)) as mes FROM `path` GROUP BY mes";

        $resultado = $this->mysqli->query($sql);
        while ($columna = mysqli_fetch_assoc($resultado)) {
            $data[] = $columna;
        }

        if (isset($data)) {
            return $data;
        }
        // return $sql;

    }
}
?>