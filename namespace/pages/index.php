<?php 
	
	namespace location\dao
	{

		use \PDO;

		// classe Propriétaire

		class Proprietaire{
			private $_id;
			private $_numPiece;
			private $_Nom;
			private $_tel;

			public function __construct($id, $cni, $nom, $tel){
				$this->_id = $id;
				$this->_numPiece = $cni;
				$this->_Nom = $nom;
				$this->_tel = $tel;
			}

			// accesseurs de le classe propriétaire

			public function numPiece(){
				return $this->_numPiece;
			}

			public function Nom(){
				return $this->_Nom;
			}

		
			public function tel(){
				return $this->_tel;
			}

		}

		// Classe qui gère les propriétaires

		class gestionProprietaire{

			private $_bdd;

			// constructeur de la classe

			public function __construct(PDO $bdd){
				$this->_bdd  = $bdd;
			}

			public function add(Proprietaire  $p){
				$sql = $this->_bdd->prepare("INSERT INTO Proprietaire VALUES (null, :numPiece, :Nom, :tel)");
				$sql->execute(array(
					'numPiece' => $p->numPiece(),
					'Nom' => $p->Nom(),
					'tel' => $p->tel()
				));
			}

			// methode permet de modifier le tel d'un propriétaire

			public function update($id, $tel){
				$this->_bdd->exec('UPDATE Proprietaire SET tel="'.$tel.'" WHERE id='.$id);
			}

			//rechercher un propriétaire à travers son CNI

			public function find($cni){
				$sql = $this->_bdd->query("SELECT * FROM Proprietaire WHERE numPiece = '".$cni."'");
				return $sql;
			}

			//méthode lister qui retourne la liste des propriétaire

			public function lister(){
				$sql = $this->_bdd->query("SELECT * FROM Proprietaire");
				return $sql;
			}

			public function listerPagination($deb){
				if ($deb<0) {
					$deb=0;
				}
				$sql = $this->_bdd->query("SELECT * FROM Proprietaire LIMIT ".$deb.",4");
				return $sql;
			}
		}

		//Classe bien 

		class Bien{
			private $_id;
			private $_Nom;
			private $_adress;
			private $_montantLocation;
			private $_commission;
			private $_idTypeBien;
			private $_idProprietaire;

			// constructeur de la classe

			public function __construct($id, $Nom, $adress, $montantLocation, $commission, $idTypeBien, $idProprietaire){
				$this->_id = $id;
				$this->_Nom = $Nom;
				$this->_adress = $adress;
				$this->_montantLocation = $montantLocation;
				$this->_commission = $commission;
				$this->_idTypeBien = $idTypeBien;
				$this->_idProprietaire = $idProprietaire;
			}

			// accesseurs de la classe

			public function id(){
				return $this->_id;
			}

			public function Nom(){
				return $this->_Nom;
			}

			public function adress(){
				return $this->_adress;
			}

			public function montantLocation(){
				return $this->_montantLocation;
			}

			public function commission(){
				return $this->_commission;
			}

			public function idTypeBien(){
				return $this->_idTypeBien;
			}

			public function idProprietaire(){
				return $this->_idProprietaire;
			}

			

			// methode lister par etat

			//créer un objet Proprietaire

			//créer un objet TypeBien

		}


		// classe qui gère les bien

		class gestionBien{
			private $_bdd;

			// constructeur de la classe

			public function __construct(PDO $bdd){
				$this->_bdd  = $bdd;
			}

			//methode qui enregistre un bien et son propiétaire s'il n'existe pas

			public function add($nomB, $adress, $montantLocation, $commission, $nomP, $cni, $tel, $nomTb){

				$idP="";
				$idTb="";

				// Vérification du propriétaire

				$verifProp = $this->_bdd->query("SELECT * FROM Proprietaire WHERE numPiece='".$cni."' AND Nom='".$nomP."'");

				if ($res=$verifProp->fetch()) {
					$idP=$res['id'];
				}else{

					$this->_bdd->exec("INSERT INTO Proprietaire VALUES (null, '".$cni."', '".$nomP."', '".$tel."')");
					$idp=$this->_bdd->query("SELECT * FROM Proprietaire WHERE numPiece='".$cni."' AND Nom='".$nomP."'");
					if ($resu=$idp->fetch()) {
						$idP=$resu['id'];
					}
				}

				// Vérification du type de bien

				$verifbien = $this->_bdd->query("SELECT * FROM typeBien WHERE Nom='".$nomTb."'");

				if ($res=$verifbien->fetch()) {
					$idTb=$res['id'];
				}else{
					$this->_bdd->exec("INSERT INTO typeBien VALUES (null, '".$nomTb."')");
					$idb = $this->_bdd->query("SELECT * FROM typeBien WHERE Nom='".$nomTb."'");
					if ($res=$idb->fetch()) {
						$idTb=$res['id'];
					}

				}

				$sql = $this->_bdd->prepare("INSERT INTO Bien VALUES (null, :Nom, :adress, :montantLocation, :commission, :idTypeBien, :idProprietaire)");
				$sql->execute(array(
					'Nom' => $nomB,
					'adress' => $adress,
					'montantLocation' => $montantLocation,
					'commission' => $commission,
					'idTypeBien' => $idTb,
					'idProprietaire' => $idP
				));
			}

			//methode update qui permet de modifier les données des bien mais le propriétaire n'est pas modifiable

			// public function update(Bien $b, ){

			// }

			//methode find qui permet de retrouver un bien à travers son nom

			public function find($Nom){
				$sql = $this->_bdd->query("SELECT * FROM Bien WHERE Nom = '".$Nom."'");
				return $sql;
			}

			//methode lister qui retourne la liste des biens

			public function lister(){
				$sql = $this->_bdd->query("SELECT b.Nom as nomb, adress, montantLocation, commission, p.Nom as nomp, tb.Nom as nomtb, numPiece FROM Bien as b, Proprietaire as p, typeBien as tb WHERE p.id=idProprietaire AND tb.id = idTypeBien");
				return $sql;
			}

			//methode listerByType qui retourne tous les biens d'un type donnée qui prend en paramètre l'id

			public function listerByType($idType){
				$sql = $this->_bdd->query("SELECT * FROM Bien WHERE idTypeBien =".$idType);
				return $sql;
			}
		}




		// Classe type bien

		class TypeBien{

			private $_id;
			private $_Nom;


			//methode add qui permet d'enregister un bien.

			//methode lister qui liste les types de bien.

			//methode findById qui retourne un type de bien à travers son id.
		}
		class utilisateur{

			private $_id;
			private $_nomComplet;
			private $_login;
			private $_password;
			private $_profil;

			// constructeur de la classe

			public function __construct($id, $nomComplet, $login, $password, $profil){
				$this->_id = $id;
				$this->_nomComplet = $nomComplet;
				$this->_login = $login;
				$this->_password = $password;
				$this->_profil = $profil;

			}

			// accesseurs de le classe

			public function id(){
				return $this->_id;
			}

			public function nomComplet(){
				return $this->_nomComplet;
			}

			public function login(){
				return $this->_login;
			}

			public function password(){
				return $this->_password;
			}

			public function profil(){
				return $this->_profil;
			}
		}

		// classe qui gère les utilisateur

		class gestionUtilisateur{

			private $_bdd;

			// constructeur de la classe

			public function __construct(PDO $bdd){
				$this->_bdd  = $bdd;
			}

			//methode add qui enregistre un utilisateur avec l'etat -1(pas encore activé).

			public function add(utilisateur $u){
				$sql = $this->_bdd-> prepare("INSERT INTO utilisateur VALUES (null, :nomComplet, :login, :password, :profil, :etat)");
				$sql -> execute(array(
					'nomComplet' => $u->nomComplet(),
					'login' => $u->login(),
					'password' => $u->password(),
					'profil' => $u->profil(),
					'etat' => -1
				));
			}

			//methode activer/desactiver qui permet d'activer ou de désactiver un utilisateur.

			public function changeEtat($id){
				$sql = $this->_bdd->query("SELECT * FROM utilisateur WHERE id = ".$id);
				if ($res = $sql->fetch()) {
					$eta;
					if($res['etat'] == -1 || $res['etat'] == 0){   //si l'utilisateur n'est pas encore activé oubien s'il est désactivé
						$eta = 1;
					}
					else   //s'il est activé, on le désactive
						$eta = 0;

					$this->_bdd->exec("UPDATE utilisateur SET etat = ".$eta." WHERE id=".$id);
				}
			}

			public function supprimer($id){
				$this->_bdd->exec("DELETE FROM utilisateur WHERE id=".$id);
			}

			//methode listerUser qui retourne la liste des utilisateur.

			public function lister(){
				$sql = $this->_bdd->query("SELECT * FROM utilisateur ORDER BY id DESC");
				return $sql;
			}

			public function listerPagination($deb, $fin){
				$sql = $this->_bdd->query("SELECT * FROM utilisateur LIMIT ".$deb.",".$fin." ");
				return $sql;
			}

			//methode logon qui permet de se loger qui aura en paramétre (login et mot de passe) et qui retourne l'utilisateur.

			public function connexion($login, $pw){
				$sql = $this->_bdd->query("SELECT * FROM utilisateur WHERE login='".$login."' AND password='".$pw."'");
				return $sql;
			}

			//methode changepwd permettant à un utilisateur de changer un mot de passe.

			public function changepw($id, $pw){
				$sql = $this->_bdd->query("SELECT * FROM utilisateur WHERE id = ".$id);
				if ($res = $sql->fetch()) {
					$this->_bdd->exec("UPDATE utilisateur SET password = '".$pw."' WHERE id=".$id);
				}
				
			}

		}
	}

	//Bien et utilisateur à faire pour moi. Ndeye maguette thiane.

?>
