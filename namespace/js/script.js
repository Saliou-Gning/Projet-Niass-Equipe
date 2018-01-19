$(document).ready(function () {


	$.get("../include/listuser.php", function(data){
		$("#utilisateur").html(data);
	})

	setInterval(()=>{
		$.get("../include/listuser.php", function(data){
			$("#utilisateur").html(data);
		})
	}, 1000);

	$("#deconnect").on("click", function(){
		$.post("../include/deconnexion.php", function(){
			$(location).attr("href", "connexion.php");
		})
	})

	$("#ajouter").on("click", function(){
		var nom = $("#nomComplet").val();
		var login = $("#login").val();
		var password = $("#password").val();
		var profil = $("#Profil").val();

		if (nom=="" || login=="" || password=="" || profil=="") 
			alert("Veuillez saisir tous les champs");
		else
			$.post("../include/ajout.php", {nom:nom, login:login, password:password, profil:profil, ajouter:"ok"}, function(){})
		
	})

		
})
