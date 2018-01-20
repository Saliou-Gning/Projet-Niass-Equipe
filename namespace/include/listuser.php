<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<style type="text/css">
    button{
        width: 100px;
    }
</style>
<body>
<?php

    require '../pages/index.php';

    use location\dao\utilisateur;
    use location\dao\gestionUtilisateur;

    include '../pages/db.php';

    $gestion = new gestionUtilisateur($db);

    $liste = $gestion->lister();

    if ($donne = $liste->fetch()) {
        echo "<table class='table table-striped table-bordered table-hover'>";
            echo '<thead class="thead-dark">';
                echo "<tr>";
                    echo "<th scope='col'>Nom Complet</th>";
                    echo "<th scope='col'>Login</th>";
                    echo "<th scope='col'>Password</th>";
                    echo "<th scope='col'>Profil</th>";
                    echo "<th scope='col'>Etat</th>";
                    echo "<th scope='col'>Actions</th>";
                echo "</tr>";
            echo "</thead>";
            do{
                echo "<tr>";
                    echo "<td>".$donne['nomComplet']."</td>";
                    echo "<td>".$donne['login']."</td>";
                    echo "<td>".$donne['password']."</td>";
                    echo "<td>".$donne['profil']."</td>";

                    if ($donne['etat']==1)
                        echo "<td>Actif</td>";
                    else
                        echo "<td>Bloqué</td>";
                    if ($donne['etat']==1)
                        echo "<td> <button href='#' class='etat btn btn-secondary' id='".$donne['id']."'>Bloquer</button>  <button class='supprimer btn btn-danger' id='".$donne['id']."' href='#'>Supprimer</button></td>";
                    else
                        echo "<td> <button class='etat btn btn-secondary' id='".$donne['id']."' href='#'>Activer</button>  <a class='supprimer btn btn-danger' id='".$donne['id']."' href='#'>Supprimer</a></td>";
            }while ($donne = $liste->fetch());
            echo "</table>";
    }

?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".etat").on("click", function(){
            $.post("../include/ajout.php",{etat:$(this).attr("id")}, function(){})
        })

        $(".supprimer").on("click", function(){
            $.post("../include/ajout.php",{supprimer:$(this).attr("id")}, function(){})
        })

    })
</script>
</body>
</html>

