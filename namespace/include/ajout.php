<?php

	require '../pages/index.php';

	use location\dao\utilisateur;
	use location\dao\gestionUtilisateur;

	include '../pages/db.php';

    $gestion = new gestionUtilisateur($db);

    extract($_POST);

    if (isset($etat)) {
    	$gestion->changeEtat($etat);
    }

    if (isset($supprimer)) {
    	$gestion->supprimer($supprimer);
    }

    if (isset($ajouter)) {
    	$u = new utilisateur(0, $nom, $login, $password, $profil);
        $gestion->add($u);
    }
    


?>