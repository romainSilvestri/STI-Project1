<?php
session_start();

if(!isset($_SESSION['user_id']) or $_SESSION['user_id'] != 0){
    header('Location: 404.php');
}
include_once("database/database.php");
$data = ListUser();
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Tables</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="view.php">Boite de réception</a>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="read-write-message.php">Nouveau</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="view.php">Lecture</a>
          </div>
        </li>

        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
             <a class="dropdown-item" href="admin.php">Administration</a>
             <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="add-edit-user.php">Nouvel utilisateur</a>
              <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="change-password.php">Reset Password</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <div id="content-wrapper">

        <div class="container-fluid">

         

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Data Table Example</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nom d'utilisateur</th>
                      <th>Role</th>
                      <th>Actif</th>
                      <th>Supprimer</th>
                      <th>Éditer</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Nom d'utilisateur</th>
                        <th>Role</th>
                        <th>Actif</th>
                        <th>Supprimer</th>
                        <th>Éditer</th>
                    </tr>
                  </tfoot>
                  <tbody>

                  <?php
                  foreach ($data as $row) {
                      echo('<tr>');
                      echo "<td>" . $row['login'] . "</td>";
                      echo "<td>" . ($row['role'] == 0 ? "admin":"utilisateur"). "</td>";
                      echo "<td>" . ($row['valid'] == 1 ? "oui" : "non") . "</td>";
                      echo('<td><a class="dropdown-item" href="add-edit-user.php">Supprimer</a></td>');
                      echo('<td><a class="dropdown-item" href="add-edit-user.php">Éditer</a></td>');
                      echo "<tr/>";
                  }
                  ?>
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="validate-logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>

  </body>

</html>
