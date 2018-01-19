<?php

	session_start();

	if (!$_SESSION['admin']) {
		header('location: connexion.php');
	}
	require 'index.php';

    use location\dao\gestionProprietaire;

?>

<!DOCTYPE html>
<html>
<head>
	<title>PAGE D'ACCEUIL ADMIN</title>

	<!-- link bootstrap -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>

</head>
<body style="background-image: url('../images/ges.jpg'); background-size: cover;">
	<div class="container">
		<br>
		<nav class="navbar navbar-expand-lg navbar-light bg-info">
			<a class="navbar-brand" href="#">ADMIN</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			 </button>

			 <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav mr-auto">
			      	<li class="nav-item active">
			        	<a class="nav-link" href="#">ACCUEIL</a>
			      	</li>
			      	<li class="nav-item dropdown">
			        	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          		UTILISATEUR
			        	</a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          	<a class="dropdown-item" href="#">Activer</a>
				          	<div class="dropdown-divider"></div>
				          	<a class="dropdown-item" href="#">Désactiver</a>
				          	<div class="dropdown-divider"></div>
				          	<a class="dropdown-item" href="#">Bloquer</a>
				        </div>
			      	</li>
			      	<li class="nav-item">
			        	<a class="nav-link " href="#">PROFIL</a>
			      	</li>
			    </ul>
			    <form method="POST" action="" class="form-inline my-2 my-lg-0">
			      	
			    </form>
			    <button class="btn btn-danger my-2 my-sm-0" id="deconnect">Déconnexion</button>
			</div>
		</nav>
			<br>
		<div class="row">
			<div class="col-4">
				<img src="../images/gestion-locative-en-ligne.jpg" style="width: 100%;">
			</div>
			<div class="col-8">
				<center><h1>Liste des utilisateurs</h1></center>
				<div id="utilisateur" class="bg-light"></div>
				<p></p>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Nouveau</button>
  
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog" role="document">
				      <div class="modal-content"  style="background: rgba(  179, 182, 183 );">
				        <div class="modal-header">
				          <h1 class="modal-title text-primary" id="exampleModalLabel">AJOUT D'UTILISATEUR</h1>
				          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				            <span aria-hidden="true">&times;</span>
				          </button>
				        </div>
				        <div class="modal-body">
				          <form method="POST" class="formulaire">
				            <div class="form-group">
							    <label for=""><B>Nom Complet</B></label>
							    <input type="text" class="form-control" id="nomComplet" placeholder="Entrer le nom de l'utilisateur">
							</div>
							<div class="form-group">
							    <label for=""><B>Login</B></label>
							    <input type="text" class="form-control" id="login" placeholder="Entrer son login">
							</div>
							<div class="form-group">
							    <label for=""><B>Mot de passe</B></label>
							    <input type="password" class="form-control" id="password" placeholder="Entrer son mot de passe">
							</div>
				            <div class="form-group">
                           		<label><B>Profil:</B></label>
	                            <select class="form-control" id="Profil">
	                              <option value=""></option>
	                              <option value="agent">AGENT</option>
	                              <option value="gerant">GERANT</option>
	                              <option value="admin">ADMIN</option>
	                            </select>
                        	</div>
				           <center> <button id="ajouter" data-dismiss="modal" class="btn btn-primary">Ajouter</button></center>
				          </form>
				        </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
				        </div>
				      </div>
				    </div>
				</div>
			</div>
			
		</div>
		<br>
		<center>
			<h1><i>Rechercher de propriétaire</i></h1>
			<form method="POST" action="">
                <div class="form-group">
                    <input type="text" class="form-control" name="cni"  placeholder="Entrez le cni du propriétaire" style="width: 250px;"><br>
                    <button type="submit" class="btn btn-secondary" name="recherche">Rechercher</button>
                </div>
            </form>
	        <div style="width: 700px;">
	        	<?php
	            	extract($_POST);
	            	if (isset($recherche)) {



	            		$db = new PDO('mysql:host=localhost;dbname=BDLocation', 'root', 'passer');
						$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

						$gestion = new gestionProprietaire($db);

						if ($cni=="") {
							echo "<table class='table table-bordered bg-light'>";
								echo "<thead class='thead-dark'>";
									echo "<th scope='col'>Numéro de piéce</th>";
									echo "<th scope='col'>Nom</th>";
									echo "<th scope='col'>Numéro de téléphone</th>";
								echo "</thead>";

							$liste = $gestion->lister();

							while ($donnee=$liste->fetch()) {
								echo "<tr>";
									echo "<td>".$donnee['numPiece']."</td>";
									echo "<td>".$donnee['Nom']."</td>";
									echo "<td>".$donnee['tel']."</td>";
								echo "</tr>";
							}
							echo "</table>";
						}else{
							$p = $gestion->find($cni);
							if ($donnee = $p->fetch()) {
								echo "<table class='table table-bordered bg-light'>";
									echo "<thead class='thead-dark'>";
										echo "<th scope='col'>Numéro de piéce</th>";
										echo "<th scope='col'>Nom</th>";
										echo "<th scope='col'>Numéro de téléphone</th>";
									echo "</thead>";

									echo "<tr>";
										echo "<td>".$donnee['numPiece']."</td>";
										echo "<td>".$donnee['Nom']."</td>";
										echo "<td>".$donnee['tel']."</td>";
									echo "</tr>";
								echo "</table>";
							}else
								echo "<span class='alert alert-danger'>Ce propriétaire n'est pas encore ajouté</span>";;
						}
							
	            	}
	            ?>
	        </div>
	        <br><br><br>
		</center>
	</div>
<script type="text/javascript" src="../js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>