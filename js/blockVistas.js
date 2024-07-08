

function showView(e,field,id,edit="",name="",rol=""){

	let Window = document.getElementById(id);



	// let statusWindow = Window.style.display;

	let statusWindow = Window.style.display;

	$(".View").attr('style', 'display: none'); 
	
	if(statusWindow == "none"){
	  Window.style.display = "block";
	}else{
	   Window.style.display = "none";
	}

	let UploadImg = document.getElementById("UploadImg").style.display;
	let SearchImg = document.getElementById("SearchImg").style.display;
	let SearchExcel = document.getElementById("SearchExcel").style.display;
	let NewUser = document.getElementById("NewUser").style.display;
	let SearchUser = document.getElementById("SearchUser").style.display;
	let EditPass = document.getElementById("EditPass").style.display;

	// alert(id);
	// alert(edit);

	if (edit!="" && id=="EditPass") {
		editt=id;
		id=edit;
	// alert("x");

		// editPass(id,name,rol);
		document.getElementById('id'+editt).value = id;
		document.getElementById('name'+editt).value = name;
		document.getElementById('rol'+editt).value = rol;
		// idEditUser
	}else if(id=="SearchUser"){
        $.ajax({
            type: "POST",
            // url: "consultarAJAX/ajaxFunction.php",
            url: "consultar/admin/table.php",
            data: 'funcion1=refreshTale',
            success: function (msg) {
                // alert(msg);
                $("#tableUser").html(msg);

                // location.reload();
            }
        });
	}else if(UploadImg== "none" &&
			SearchImg== "none" &&
			SearchExcel== "none" &&
			NewUser== "none" &&
			SearchUser== "none" &&
			EditPass== "none"){
		document.getElementById("inicio").style.display = "block";
		// document.getElementById("inicio").style.text-align= "center";

	}

  	var rediret = document.getElementById("redirect").value;

	if(id!="UploadImg" && rediret=="entro"){
		document.getElementById("lista_imagenes").innerHTML= "";
		// document.getElementById("lista_imagenes").innerHTML= "";
	}

	if(rediret=="entro"){
		// alert("mmm");
		// location.reload();
		// <script type="text/javascript">window.location="../boddy.php";</script>
	}

} 

// function editPass(id,name,rol){
//         $.ajax({
//             type: "POST",
//             url: "consultarAJAX/ajaxFunction.php",
//             // url: "consultar/admin/table.php",
//             data: 'funcion1=consultDataEdit&table='+table+'&active='+active+'&id='+id,
//             success: function (msg) {
//                 // alert(msg);
//                 $("#tableUser").html(msg);

//                 // location.reload();
//             }
//         });	
// }



