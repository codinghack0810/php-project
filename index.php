<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>lanred.mx - Sistema De Control</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="css/CSSlogin.css">

</head>
<body>
<?php
// include ("include/menu.php");
?>
<!-- partial:index.partial.html -->
<hgroup>
  <!-- <h1>lanred.mx</h1> -->
  <img src="images/lanred.jpg" style="width: 350px; height: 150px; padding-left: 5px; padding-right: 5px; border-radius: 0.5rem; " class="w3-round">
  <!-- <h3>By Josh Adamous</h3> -->
</hgroup>
<form name="loginform" id="loginform" action="consultar/login.php" method="POST">
  <div class="group">
    <label style="position: initial!important; color: #1b00ff;">Usuario</label>
    <input type="text" name="username" id="username">
    <span class="highlight"></span>
    <!-- <span class="bar"></span> -->
  </div>
  <div class="group">
    <label style="position: initial!important; color: #1b00ff;">Contraseña</label>
    <input type="password" name="password" id="password">
    <span class="highlight"></span>
    <!-- <span class="bar"></span> -->
  </div>
  <button type="submint" class="button buttonBlue">Iniciar Session
    <div class="ripples buttonRipples">
      <span class="ripplesCircle"></span>
    </div>
  </button>
</form>
<footer>
</footer>
<!-- partial -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
