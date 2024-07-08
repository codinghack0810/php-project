<div id="DivMenu">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mySidebar" aria-controls="mySidebar" aria-expanded="false"aria-label="Toggle navigation" style="" id="botonMenu">
    <span class="navbar-toggler-icon btn_menu icon-menu"></span>
  </button>  
</div>


<!-- Sidebar/menu -->

<nav class="sidebar" id="mySidebar"><br>

  <div class="w3-container">
<!--     <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a> -->


    <!-- <img src="images/logo.png" style="width:100%; padding-left: 5px; padding-right: 5px;" class="w3-round"><br><br> -->
     <a href="boddy.php" style="cursor: pointer;">
    <img src="images/monitorcenter.jpg" style="width:100%; padding-left: 5px; padding-right: 5px; border-radius: 0.5rem; " class="w3-round">
    </a>
  <br><br>
  </div>

  <!-- <div class="w3-bar-block"> -->
    <ul >
      <?php if($rol=="Administrador" || $rol=="Monitorista"){  ?>
      <li>
        <a href="#"  class="menu_item">
          <i class="fa fa-th-large fa-fw"></i>
          Imagenes
        </a>
        <ul class="submenu">
          <li><i class="bi bi-dash"></i>
            <a href="#" onclick="showView(event,this,'UploadImg')">Cargar Imagenes</a>
          </li>
          <li>
            <i class="bi bi-dash"></i>
            <a href="#" onclick="showView(event,this,'SearchImg')">Buscar imagenes</a>
          </li>
        </ul>                   
      </li>
      <?php   } ?>

      <li>
        <a href="#" class="menu_item">
          <i class="fa fa-file fa-fw w3-margin-right"></i>
          Informes
        </a> 
        <ul class="submenu">
          <li>
            <i class="bi bi-dash"></i>
                  <!-- <a href="consultar/createExcel.php?variable1=valor1&variable2=valor2" target="_blank" >Descargar Excel</a> -->
            <a href="#" onclick="showView(event,this,'SearchExcel')">Buscar Informe</a>
          </li>
<!--           <li>
            <i class="bi bi-dash"></i>
            <a href="#" onclick="showView(event,this,'SearchPdf')">Descargar PDF</a>
          </li> -->
        </ul>                 
      </li>

      <?php if($rol=="Administrador"){  ?>
      <li>
        <a href="#"  class="menu_item">
          <i class="fa fa-user fa-fw w3-margin-right"></i>
          Usuarios
        </a>  
        <ul class="submenu">
                <li>
                  <i class="bi bi-dash"></i>
                  <a href="#" onclick="showView(event,this,'NewUser')">Registrar</a>
                </li>
                <li>
                  <i class="bi bi-dash"></i>
                  <a href="#" onclick="showView(event,this,'SearchUser')">Buscar</a>
                </li>            
        </ul> 
      </li>
      <?php   } ?>
    </ul>

    


  <!-- </div> -->
</nav>

