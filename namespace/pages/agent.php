<?php

	session_start();

	if (!$_SESSION['agent']) {
		header('location: connexion.php');
	}
	require 'index.php';

	use location\dao\Proprietaire;
    use location\dao\gestionProprietaire;

    include 'db.php';

    extract($_POST);

	if (isset($ajouter)) {

		if ($cni!="" && $nomComplet!="" && $tel!="") {
			$p = new Proprietaire(0, $cni, $nomComplet, $tel);
			$gestion = new gestionProprietaire($db);
			$gestion->add($p);
		}
		
	}

	if (isset($modifier)) {
		if ($tel!="") {
			$gestion = new gestionProprietaire($db);
			$gestion->update($id, $tel);
		}
	}

	if (isset($_POST['deconect'])) {
		session_destroy();
		header('location: connexion.php');
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>PAGE D'ACCEUIL AGENT</title>

	<!-- link bootstrap -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<style type="text/css">
	#recup{
		display: none;
	}
</style>
</head>
<body style="background-image: url('../images/BusinessPartners.jpg'); background-size: cover;">
	<div class="container">
		<br>
		<nav class="navbar navbar-expand-lg navbar-light bg-primary">
			<a class="navbar-brand" href="#">AGENT</a>
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
			          		LOCATION
			        	</a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          	<a class="dropdown-item" href="#">Add</a>
					     </div>
			      	</li>
			    </ul>
			    <form method="POST" action="" class="form-inline my-2 my-lg-0">
			      	<button class="btn btn-danger my-2 my-sm-0" name="deconect" type="submit" style="margin-left: 100px;">Déconnexion</button>
			    </form>
			</div>
		</nav>
		<br>
		<div class="row">
			<div class="col-4">
				<img src="../images/service-gestion-locative.jpg">
			</div>
			<div class="col-1">
				
			</div>
			<div class="col-7">
				<?php

					$db = new PDO('mysql:host=localhost;dbname=BDLocation', 'root', 'passer');
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
					$gestion = new gestionProprietaire($db);

					echo "<center><h1>Liste des propriétaires</h1></center>";
					echo "<table class='table table-bordered bg-light'>";
						echo "<thead class='thead-dark'>";
							echo "<th scope='col'>Numéro de piéce</th>";
							echo "<th scope='col'>Nom</th>";
							echo "<th scope='col'>Numéro de tel</th>";
							echo "<th scope='col'>Action</th>";
						echo "</thead>";

					$liste = $gestion->lister();

					while ($donnee=$liste->fetch()) {
						echo "<tr>";
							echo "<td>".$donnee['numPiece']."</td>";
							echo "<td>".$donnee['Nom']."</td>";
							echo "<td>".$donnee['tel']."</td>";
							echo '<td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#'.$donnee['id'].'">Update</button></td>';
							echo '<div class="modal fade" id="'.$donnee['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							    <div class="modal-dialog" role="document">
							      <div class="modal-content"  style="background: rgba(   244, 246, 247 );">
							        <div class="modal-header">
							          <h1 class="modal-title text-primary" id="exampleModalLabel">Modification</h1>
							          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							            <span aria-hidden="true">&times;</span>
							          </button>
							        </div>
							        <div class="modal-body">
							          <form method="POST">
										<div class="form-group">
										    <label for=""><B>Proprietaire à modifier</B></label>
										    <input type="text" class="form-control" value='.$donnee['Nom'].' name="nomComplet" placeholder="Entrer son login" readonly>
										    <input type="text" class="form-control" value='.$donnee['id'].' id="recup" name="id">
										</div>
										<div class="form-group"><B>Nouveau numéro de tel</B>
										    <label for=""></label>
										    <input type="text" class="form-control" name="tel" placeholder="Entrer son mot de passe">
										</div>
							           <center> <button type="submit" name="modifier" class="btn btn-primary">Modifier</button></center>
							          </form>
							        </div>
							        <div class="modal-footer">
							          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
							        </div>
							      </div>
							    </div>
							</div>';
						echo "</tr>";
					}
					echo "</table>";
				?>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Nouveau</button>
  
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog" role="document">
				      <div class="modal-content"  style="background: rgba( 244, 246, 247 );">
				        <div class="modal-header">
				          <h1 class="modal-title text-primary" id="exampleModalLabel">Ajout de propriétaire</h1>
				          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				            <span aria-hidden="true">&times;</span>
				          </button>
				        </div>
				        <div class="modal-body">
				          <form method="POST">
				            <div class="form-group">
							    <label for=""><B>Numéro de pièce d'identité</B></label>
							    <input type="text" class="form-control" name="cni" placeholder="Entrer le nom de l'utilisateur">
							</div>
							<div class="form-group">
							    <label for=""><B>Nom complet</B></label>
							    <input type="text" class="form-control" name="nomComplet" placeholder="Entrer son login">
							</div>
							<div class="form-group"><B>Téléphone</B>
							    <label for=""></label>
							    <input type="text" class="form-control" name="tel" placeholder="Entrer son mot de passe">
							</div>
				           <center> <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button></center>
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
	</div>
</body>
</html>