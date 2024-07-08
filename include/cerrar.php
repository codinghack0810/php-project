<?php
session_start();
session_unset();        
session_destroy();
unset($_SESSION['user_name']); 
unset($_SESSION['name_rol']); 
unset($_SESSION['iduser']); 
unset($_SESSION['activa']); 
//unset($_SESSION['usuario']);    
                    
Header("Location:../index.php");

?>
