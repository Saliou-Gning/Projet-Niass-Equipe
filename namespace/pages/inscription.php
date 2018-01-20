<!DOCTYPE html>
<html>
<head>
    <title>inscription-gestion-location</title>

    <!-- link bootstrap -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>

</head>
<body style="background-image: url('../images/BusinessPartners.jpg'); background-size: cover;">

    <div class="container">
        <br>
        <center>
            <div id="connexion" style="width: 600px;">
            <div class="card" style="background: rgba(0,0,0,0.5);">
                <div class="card-body">
                    <a href=""><i class="fa fa-home fa-5x" aria-hidden="true" style="float: left; color: white;"></i></a><br>
                    <center><h1 class="text-primary">Page d'inscription</h1><br></center>
                    <form method="POST" action="">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><B>Nom complet:</B></label>
                            <input type="text" class="form-control col-lg-8" name="nomcomplet"  placeholder="Entrez votre Nom complet">
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><B>Login :</B></label>
                            <input type="text" class="form-control col-lg-8" name="login"  placeholder="Entrez votre login">
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><B>Password :</B></label>
                            <input type="password" class="form-control col-lg-8" name="pw" placeholder="Votre mot de passe">
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3"><B>Profil:</B></label>
                            <select class="form-control col-lg-8" name="Profil">
                              <option value=""></option>
                              <option value="agent">AGENT</option>
                              <option value="gerant">GERANT</option>
                              <option value="admin">ADMIN</option>
                              <option value="proprietaire">PROPRIÉTAIRE</option>
                            </select>
                        </div>
                        <center>
                            <input type="submit" name="inscription" class="btn btn-primary" value="Enregistrer"><br><br>
                            <a href="connexion.php" style="color: white;">Se connecter</a>
                        </center>                        
                        
                    </form>
                </div>
                <center>
                    <?php 
                        
                        require 'index.php';

                        use location\dao\utilisateur;
                        use location\dao\gestionUtilisateur;

                        include 'db.php';

                        extract($_POST);
                        if (isset($inscription)) {
                            if ($nomcomplet=="" || $login == "" || $pw == "" || $Profil =="") {
                                echo "<span class='alert alert-danger'>Veuillez saisir tous les champs</span>";
                            }
                            else{
                                $u = new utilisateur(0, $nomcomplet, $login, $pw, $Profil);
                                $gestion = new gestionUtilisateur($db);
                                $gestion->add($u);
                                echo "<span class='alert alert-secondary'>Utilisateur ajouté avec succés</span>";

                            }
                        }
                    ?>
                </center>
                <br><br>.
            </div>
        </div>
        </center>
    </div>

</body>
</html>
