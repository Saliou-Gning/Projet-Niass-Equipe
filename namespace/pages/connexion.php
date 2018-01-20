<!DOCTYPE html>
<html>
<head>
    <title>inscription-gestion-location</title>

    <!-- link bootstrap -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    

</head>
<body style="background-image: url('../images/BusinessPartners.jpg'); background-size: cover;">

    <div class="container">
        <center>
            <br>
            <div id="connexion"  style="width: 550px;">
                <div class="card" style="background: rgba(0,0,0,0.5);">
                    <div class="card-body">
                        <a href=""><i class="fa fa-home fa-5x" aria-hidden="true" style="color: white;"></i></a><br>
                        <center><h1 class="text-primary bg-dark">Page de connexion</h1><br></center>
                        <form method="POST" action="">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"><B>Login <i class="fa fa-user-circle" aria-hidden="true"></i>:</B></label>
                                <input type="text" class="form-control col-lg-6" name="login"  placeholder="Entrez votre login">
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"><B>Password <i class="fa fa-key" aria-hidden="true"></i>:</B></label>
                                <input type="password" class="form-control col-lg-6" name="pw" placeholder="Votre mot de passe">
                            </div>
                            <center>
                                <input type="submit" class="btn btn-primary" name="connexion" value="Se connecter"><br><br>
                                <a href="inscription.php" style="color: white;">S'inscrire</a>
                            </center>                    
                            
                        </form>
                        <br>
                        <center>
                            <?php 

                                require 'index.php';

                                use location\dao\utilisateur;
                                use location\dao\gestionUtilisateur;

                                include 'db.php';

                                 extract($_POST);
                                 if(isset($connexion)){
                                    if ($login == "" || $pw == "") {
                                          echo "<span class='alert alert-secondary'>VEUILLEZ SAISIR TOUS LES CHAMPS</span>";
                                      }else{
                                        $gestion = new gestionUtilisateur($db);
                                        $sql=$gestion->connexion($login, $pw);
                                        if ($res = $sql->fetch()) {
                                            session_start();

                                            if ($res['etat']==1) {
                                                if ($res['profil']=="admin") {
                                                    header('location:menuadmin.php');
                                                    $_SESSION['admin'] = "admin";
                                                }
                                                if ($res['profil']=="agent") {
                                                    header('location:agent.php');
                                                    $_SESSION['agent'] = "agent";
                                                }
                                                if ($res['profil']=="gerant") {
                                                    header('location:gerant.php');
                                                    $_SESSION['gerant'] = "gerant";
                                                }
                                                if ($res['profil']=="proprietaire") {
                                                    header('location:proprietaire.php');
                                                    $_SESSION['proprietaire'] = "proprietaire";
                                                }
                                            }else
                                                echo "<span class='alert alert-secondary'>VEUILLEZ CONTACTER L'ADMINISTRATEUR</span>";
                                        }
                                        else
                                            echo "<span class='alert alert-danger'>LOGIN OU MOT DE PASSE INCORRECT</span>";
                                      
                                      }
                                 }

                            ?>
                        </center>
        
                    </div>
                </div>
            </div>
        </center>
        <br>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</body>
</html>