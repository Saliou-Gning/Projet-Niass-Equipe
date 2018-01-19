<?php

	require '../pages/index.php';

	use location\dao\utilisateur;
	use location\dao\gestionUtilisateur;

	$db = new PDO('mysql:host=localhost;dbname=BDLocation', 'root', 'passer');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

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