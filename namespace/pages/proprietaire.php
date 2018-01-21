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
        <br>
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <a class="navbar-brand" href="#">PROPRIÉTAIRE</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
             </button>

             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">ACCUEIL</a>
                    </li>
                    <div id="modal">
                      <!-- Button trigger modal -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Mes contrats</a>
                     
                      

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">contrat</h4>
      </div>
       <?php
       include 
       ('ajoutcontrat.php')
       ?>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
                        </div>
                      
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mes biens</a>
                    </li>
                </ul>
                <form method="POST" action="" class="form-inline my-2 my-lg-0">
                    
                </form>
                <input type="button" class="btn btn-danger my-2 my-sm-0" id="deconnect" value="Déconnexion">
            </div>
        </nav>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</body>


</html>