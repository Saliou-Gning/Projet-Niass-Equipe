<?php

	session_start();

	if (!$_SESSION['gerant']) {
		header('location: connexion.php');
	}
	require 'index.php';

    use location\dao\Bien;
    use location\dao\gestionBien;

    include 'db.php';

	extract($_POST);

	if (isset($ajouter)) {
		$gestion = new gestionBien($db);

		if ($nombien!="" && $adress!="" && $montantLocation!="" && $nomp!="" && $nomtb=!"") {
			# code...
		}
		$gestion->add($nombien, $adress, $montantLocation, $commission, $nomp, $cni, $tel, $nomtb);
	}

	if (isset($_POST['deconect'])) {
		session_destroy();
		header('location: connexion.php');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>PAGE D'ACCEUIL GERANT</title>
	<meta charset="utf-8">

	<!-- link bootstrap -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>

</head>
<body style="background-image: url('../images/ges2.png'); background-size: cover;">
	<div class="container">
		<br>
		<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
			<a class="navbar-brand" href="#">GERANT</a>
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
			          		CONTRAT
			        	</a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          	<a class="dropdown-item" href="#">Add</a>
				          	<div class="dropdown-divider"></div>
				          	<a class="dropdown-item" href="#">Modifier</a>
				          	<div class="dropdown-divider"></div>
				          	<a class="dropdown-item" href="#">Annuler</a>
				        </div>
			      	</li>
			    </ul>
			    <form method="POST" action="" class="form-inline my-2 my-lg-0">
			      	<button class="btn btn-danger my-2 my-sm-0" name="deconect" type="submit" style="margin-left: 100px;">Déconnexion</button>
			    </form>
			</div>
		</nav>
		<br>
		<div class="container">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Nouveau</button>
  
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog" role="document">
				      <div class="modal-content"  style="background: rgba(  179, 182, 183 );">
				        <div class="modal-header">
				          <h1 class="modal-title text-primary" id="exampleModalLabel">AJOUT DE BIEN</h1>
				          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				            <span aria-hidden="true">&times;</span>
				          </button>
				        </div>
				        <div class="modal-body">
				          <form method="POST" class="formulaire">
				            <div class="form-group">
							    <label for=""><B>Nom du bien</B></label>
							    <input type="text" class="form-control" name="nombien" placeholder="Entrer le nom de l'utilisateur">
							</div>
							<div class="form-group">
							    <label for=""><B>Adresse</B></label>
							    <input type="text" class="form-control" name="adress" placeholder="Entrer son login">
							</div>
							<div class="form-group">
							    <label for=""><B>Montant Location</B></label>
							    <input type="text" class="form-control" name="montantLocation" placeholder="Entrer son mot de passe">
							</div>
				            <div class="form-group">
							    <label for=""><B>Commission</B></label>
							    <input type="text" class="form-control" name="commission" placeholder="Entrer son mot de passe">
							</div>
							<hr>
							<div class="form-group">
							    <label for=""><B>Nom propriétaire</B></label>
							    <input type="text" class="form-control" name="nomp" placeholder="Entrer son mot de passe">
							</div>
							<div class="form-group">
							    <label for=""><B>Numéro de piéce</B></label>
							    <input type="text" class="form-control" name="cni" placeholder="Entrer son mot de passe">
							</div>
							<div class="form-group">
							    <label for=""><B>Numéro de téléphone</B></label>
							    <input type="text" class="form-control" name="tel" placeholder="Entrer son mot de passe">
							</div>
							<hr>
							<div class="form-group">
							    <label for=""><B>Type de bien</B></label>
							    <input type="text" class="form-control" name="nomtb" placeholder="Entrer son mot de passe">
							</div>
				           <center><button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button></center>
				          </form>
				        </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
				        </div>
				      </div>
				    </div>
				</div>
				<p></p>
			<?php
				$gestion = new gestionBien($db);

				$sql=$gestion->lister();
			?>
			<table class='table table-bordered bg-light'>
				<thead class='thead-dark'>
					<th scope='col'>Nom bien</th>
					<th scope='col'>Adresse</th>
					<th scope='col'>Montant location</th>
					<th scope='col'>commission</th>
					<th scope='col'>Type de Bien</th>
					<th scope='col'>Nom propriétaire</th>
					<th scope='col'>Numéro de piéce</th>
				</thead>
				<?php 
					while ($donnne = $sql->fetch()) {
						?>
						<tr>
							<td><?php echo $donnne['nomb']; ?></td>
							<td><?php echo $donnne['adress']; ?></td>
							<td><?php echo $donnne['montantLocation']; ?></td>
							<td><?php echo $donnne['commission']; ?></td>
							<td><?php echo $donnne['nomtb']; ?></td>
							<td><?php echo $donnne['nomp']; ?></td>
							<td><?php echo $donnne['numPiece']; ?></td>
						</tr>
						<?php
					}
				?>	
			</table>
		</div>
	</div>

	<?php
		
	?>
</body>
</html>