<?php 
	
	namespace location\dao
	{

		// classe Propriétaire

		class Propietaire{
			private $_id;
			private $_numPiece;
			private $_Nom;
			private $_tel;


			public function update(){
				//permet de modifier le tel d'un propriétaire
				$this->getConnexion();
				// requete a executer
			   $sql= "select * from Proprietaire where tel='$tel'";
				// preparation de la requete
				$donnees = $this->bdd->query($sql);
				return $donnees;
			}

			public function find(){
				//rechercher un propriétaire à travers son CNI
				$this->getConnexion();
				$sql="select * from Proprietaire where numPiece='$numPiece'";
				$donnees = $this->bdd->query($sql);
				return $donnees;
			}
		}

			//méthode lister qui retourne la liste des propriétaire
			
		 function lister(){
			$sql = $this->_bdd->query("SELECT * FROM Proprietaire");
			echo "<table border:'1'>";
			echo "<tr>";
				echo "<th>id</th>";
				echo "<th>numPiece</th>";
				echo "<th>Nom</th>";
				echo "<th>tel</th>";
			echo "</tr>";
			while ($res = $sql->fetch()) {
				echo "<tr>";
					echo "<td>".$res['id']."</td>";
					echo "<td>".$res['numPiece']."</td>";
					echo "<td>".$res['Nom']."</td>";
					echo "<td>".$res['tel']."</td>";
					
				echo "</tr>";
			}
			echo "</table>";
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
		


			//methode qui enregistre un bien et son propiétaire s'il n'existe pas

			public function add(){

			}

			//methode update qui permet de modifier les données des bien mais le propriétaire n'est pas modifiable

			//methode find qui permet de retrouver un bien à travers son nom

			//methode lister qui retourne la liste des biens

			//methode listerByType qui retourne tous les biens d'un type donnée qui prend en paramètre l'id

			// methode lister par etat

			//créer un objet Propietaire

			//créer un objet TypeBien

		}

		// Classe 
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

			private function getConnexion(){
				$db = new PDO('mysql:host=localhost;dbname=BDLocation', 'root', 'passer');
	    		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			}

			//methode add qui enregistre un utilisateur avec l'etat -1(pas encore activé).

			public function add(){
				$this->getConnexion();
				$sql = $db-> prepare("INSERT INTO utilisateur VALUES (null, :nomComplet, :login, :password, :profil, :etat)");
				$sql -> execute(array(
					'nomComplet' => $this->_nomCompletomplet,
					'login' => $this->_login,
					'password' => $this->_password,
					'profil' => $this->_profil,
					'etat' => -1
				));
			}

			//methode activer/desactiver qui permet d'activer ou de désactiver un utilisateur.

			public function changeEtat($id){
				$this->getConnexion();
				$sql = $db->query("SELECT * FROM utilisateur WHERE id = ".$id);
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
		}

		// classe qui gère les utilisateur
		
		class gestionUtilisateur{

			private $_bdd;

			// constructeur de la classe

			public function __construct($bdd){
				$this->_bdd  = $bdd;
			}


			

			//methode listerUser qui retourne la liste des utilisateur.

			public function lister(){
				$sql = $this->_bdd->query("SELECT * FROM utilisateur");
				echo "<table border:'1'>";
				echo "<tr>";
					echo "<th>Nom</th>";
					echo "<th>Login</th>";
					echo "<th>Mot de passe</th>";
					echo "<th>Profil</th>";
					echo "<th>Etat</th>";
				echo "</tr>";
				while ($res = $sql->fetch()) {
					echo "<tr>";
						echo "<td>".$res['nomComplet']."</td>";
						echo "<td>".$res['login']."</td>";
						echo "<td>".$res['password']."</td>";
						echo "<td>".$res['profil']."</td>";
						echo "<td>".$res['etat']."</td>";
					echo "</tr>";
				}
				echo "</table>";
			}

			//methode logon qui permet de se loger qui aura en paramétre (login et mot de passe) et qui retourne l'utilisateur.

			public function connexion($login, $pw){
				$sql = $this->_bdd->query("SELECT * FROM utilisateur WHERE login='".$login."' AND password='".$pw."'");
				if ($res = $sql->fetch()) {
					echo "Connexion établie";
				}
				else
					echo "Login ou mot de passe incorrect";
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
