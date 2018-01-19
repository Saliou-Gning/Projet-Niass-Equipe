<?php 

	require 'index.php';

	use location\dao\Proprietaire;
	use location\dao\gestionProprietaire;

	 $db = new PDO('mysql:host=localhost;dbname=BDLocation', 'root', 'passer');
	 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

	 $p = new Proprietaire(0, "1247962323", "saliou", "778542233");

	 $gestion = new gestionProprietaire($db);

	 $a = $gestion->add($p);


	 

?>