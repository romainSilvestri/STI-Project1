<?php
session_start();

if(!isset($_SESSION['user_id']) or $_SESSION['user_id'] != 0){
    header('Location: 404.php');
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Register</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Register an Account</div>
        <div class="card-body">
          <form >
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="login" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                    <label for="login">Login</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="password" class="form-control" placeholder="Password" required="required">
                    <label for="password">Password</label>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                      <select class="form-control">
                          <option value="0">Type d'utilisateur :</option>
                          <option value="1">Administrateur</option>
                          <option value="2">Utilisateur</option>
                        </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    
                    
                    <label>
                        <input type="checkbox" value="isValid">
                        Le compte est actif
                      </label>
                    
                  </div>
                </div>
              </div>
            </div>
            <a class="btn btn-primary btn-block" href="#">Ajouter</a>
            <a class="btn btn-primary btn-block" href="admin.php">Retour</a>
          </form>
          
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>