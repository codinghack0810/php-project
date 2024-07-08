// solo letras sin espacios ni caracteres especiales
function isESLetterNoSpace(event) {
  tecla = document.all ? event.keyCode : event.which;
  if (tecla === 8 || tecla === 0) return true;

  patron =
    /[qwertyuiopasdfghjklñzxcvbnmQWERTYUIOPASDFGHJKLÑZXCVBNMáéíóúÁÉÍÓÚüÜ1234567890']/;
  te = String.fromCharCode(tecla);
  // te=te.toUpperCase();
  // e.value = e.value.toUpperCase();

  // alert(te);
  return patron.test(te);
}

function isMail(event) {
  tecla = document.all ? event.keyCode : event.which;
  if (tecla === 8 || tecla === 0) return true;

  patron =
    /[qwertyuiopasdfghjklñzxcvbnmQWERTYUIOPASDFGHJKLÑZXCVBNMáéíóúÁÉÍÓÚüÜ1234567890.@']/;

  te = String.fromCharCode(tecla);
  // te=te.toUpperCase();
  // e.value = e.value.toUpperCase();

  // alert(te);
  return patron.test(te);
}

function mayus(e) {
  e.value = e.value.toUpperCase();
}

function bajar(e) {
  e.value = e.value.toLowerCase();
}

function numberHoraMinSeg(event, field, id) {
  tecla = document.all ? event.keyCode : event.which;
  if (tecla === 8 || tecla === 0) return true;
  patron = /[1234567890:]/;
  te = String.fromCharCode(tecla);

  var length = field.value.length;
  var val = field.value;
  $x = document.getElementById(id);

  if (length == 8) return false;

  // if ((length<7 || length>8) && val!="") {
  //   // $x.style.borderColor= "#ff6161db";
  //   // $x.style.opacity= "70%";
  //   $x.style.border= "#ff6161db 0.15rem dashed";
  //   $x.classList.add('staticlengthstyle');
  // }else{
  //   $x.classList.remove('staticlengthstyle');
  //   $x.style.border= "none";
  // }

  return patron.test(te);
}

// function str_numHoraMinSeg(event, field, id) {
//   tecla = document.all ? event.keyCode : event.which;
//   if (tecla === 8 || tecla === 0) return true;
//   patron =
//     /[qwertyuiopasdfghjklñzxcvbnmQWERTYUIOPASDFGHJKLÑZXCVBNMáéíóúÁÉÍÓÚüÜ1234567890:]/;
//   te = String.fromCharCode(tecla);

//   $x = document.getElementById(id);

//   return patron.test(te);
// }

//onchange="minRequiredCaracter(this.value,'.$minlength.' )"
function minRequiredCaracter(val, min) {
  if (val.length < min) {
    alert("El numero de elementos no corresponde al campo procesado");
  }
}

function staticlengthstyle(e, field, id) {
  var length = field.value.length;
  var val = field.value;
  $x = document.getElementById(id);
  if ((length < 7 || length > 8) && val != "") {
    // $x.style.borderColor= "#ff6161db";
    // $x.style.opacity= "70%";
    $x.style.border = "#ff6161db 0.15rem dashed";
    $x.classList.add("staticlengthstyle");
  } else {
    $x.classList.remove("staticlengthstyle");
    $x.style.border = "none";
  }
}
function str_staticlengthstyle(e, field, id) {
  $x = document.getElementById(id);
    $x.classList.remove("staticlengthstyle");
    $x.style.border = "none";
}
