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
				

					 <center><h1>Liste des propriétaires</h1></center>
					 <table class='table table-bordered bg-light'>
						 <thead class='thead-dark'>
							 <th scope='col'>Numéro de piéce</th>
							 <th scope='col'>Nom</th>
							 <th scope='col'>Numéro de tel</th>
							 <th scope='col'>Action</th>
						 </thead>
				<?php

					
					$gestion = new gestionProprietaire($db);
					$liste = $gestion->lister();

					while ($donnee=$liste->fetch()) {
				?>
						<tr>
							 <td><?php echo $donnee['numPiece']; ?> </td>
							 <td><?php echo $donnee['Nom']; ?></td>
							 <td><?php echo $donnee['tel']; ?></td>
							 <td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#<?php echo($donnee['id']); ?>">Update</button></td>
							 <div class="modal fade" id="<?php echo($donnee['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
										    <input type="text" class="form-control" value='<?php echo($donnee['Nom']); ?>' name="nomComplet" placeholder="Entrer son login" readonly>
										    <input type="text" class="form-control" value='<?php echo($donnee['id']); ?>' id="recup" name="id">
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
							</div>
						 </tr>
					<?php } ?>
					
					 </table>
				
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
		<center>
			<br><br>
			<h1 id="recherche" class="text-light"><i>Rechercher de propriétaire</i></h1>
			<form method="POST" action="agent.php#recherche">
                <div class="form-group">
                    <input type="text" class="form-control" name="cni"  placeholder="Entrez le cni du propriétaire" style="width: 250px;"><br>
                    <button type="submit" class="btn btn-secondary" name="recherche">Rechercher</button>
                </div>
            </form>
	        <div style="width: 700px;">
	        	<?php
	            	extract($_POST);
	            	if (isset($recherche)) {


						$gestion = new gestionProprietaire($db);

						if ($cni!="") {
							$p = $gestion->find($cni);
							if ($donnee = $p->fetch()) {
				?>
								<table class='table table-bordered bg-light'>
									<thead class='thead-dark'>";
										<th scope='col'>Numéro de piéce</th>
										<th scope='col'>Nom</th>
										<th scope='col'>Numéro de téléphone</th>
										<th scope='col'>Action</th>
									</thead>

									<tr>
										<td><?php echo $donnee['numPiece']; ?></td>
										<td><?php echo $donnee['Nom']; ?></td>
										<td><?php echo $donnee['tel']; ?></td>
										<td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#<?php echo($donnee['id']); ?>">Update</button></td>

											 <div class="modal fade" id="<?php echo($donnee['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
														    <input type="text" class="form-control" value='<?php echo($donnee['Nom']); ?>' name="nomComplet" placeholder="Entrer son login" readonly>
														    <input type="text" class="form-control" value='<?php echo($donnee['id']); ?>' id="recup" name="id">
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
											</div>
									</tr>
								</table>
				<?php 
							}else
								echo "<span class='alert alert-danger'>Ce propriétaire n'est pas encore ajouté</span>";;
						}
							
	            	}
	            ?>
	        </div>
	        <br><br><br>
		</center>
	</div>
</body>
</html>