<!DOCTYPE html>
<html lang="fr">
    <head>
        <!doctype html>
        <html lang="en">
          <head>
            <title>Title</title>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
          </head>
          <style>
          body{
      background-image: url('../images/ges.jpg');
      background-repeat:no-repeat;
      background-size:cover;
      background-position-y:-90px;

          }
          </style>
          <body>
          <div class="container">
    <center>
       <form action="#" method="post">
              <h1>ajouter contrat</h1>
                  <input type="text" name="idcontrat" id="idcontrat" class="form-control" placeholder="" aria-describedby="helpId" required>
              <th>   <h3>idcontrat</h3></th>
                   
                <input type="text" name="nomproprietaire" id="nomproprietaire" class="form-control" placeholder="" aria-describedby="helpId"required >
              <th> <h3>nom proprietaire</h3></th>
                 <input type="text" name="nomlocataire" id="nomlocataire" class="form-control" placeholder="" aria-describedby="helpId"required >
             <th>  <h3>nom locataire</h3></th>
                 <input type="date" name="datedebut" id="datedebut" class="form-control" placeholder="" aria-describedby="helpId" required>
             <th> <h3>datedebut</h3></th>
                 <input type="date" name="datefin" id="datefin" class="form-control" placeholder="" aria-describedby="helpId"required >
             <th>    <h3>datefin</h3></th>
                 <input type="text" name="montantloc" id="montantloc" class="form-control" placeholder="" aria-describedby="helpId" required>
          <th>  <h3>montantloc</h3></th>
                 <input type="text" name="idbien" id="idbien" class="form-control" placeholder="" aria-describedby="helpId" required>
                <th> <h3>idbien</h3></th>
                <input type="submit" name="enregistrer" class="btn btn-primary" id="enregistrer" value="enregistrer" /required> <br/><br/>
              accepter: <input type="checkbox" name="accepter" id="accepter"><br>
               refuser :<input type="checkbox" name="refuser" id="refuser">
         </form>
</center>
</div>
              
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
          </body>
          <script>
          $(document).ready(function(){
              $('#enregistrer').hide();
              $('#accepter').click(function(){
              $('#enregistrer').show();  
              });

              
          })
          </script>
</html>