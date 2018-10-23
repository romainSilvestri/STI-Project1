<?php
session_start();
if(!isset($_SESSION['user_id'])){
header('Location: index.php');
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
      <div class="card-header">New message</div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="to" class="form-control" placeholder="Recipient" required="required" autofocus="autofocus">
              <label for="to">Recipient</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="subject" class="form-control" placeholder="Subject" required="required">
              <label for="subject">Subject</label>
            </div>
          </div>

          <div class="form-group">
            <label>Message :</label>
            <div class="form-label-group">
              <textarea class="form-control" rows="3"></textarea>
            </div>
          </div>
          <input type="submit" class="btn btn-primary btn-block" href="#" value="Submit"/>
            <a class="btn btn-primary btn-block" href="#">Delete</a>
            <a class="btn btn-primary btn-block" href="#">Answer</a>
          <a class="btn btn-primary btn-block" href="javascript:history.back()">Cancel</a>
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