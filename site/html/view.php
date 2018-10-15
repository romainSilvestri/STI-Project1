<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: index.php');
}
?>

<html>
<head>
    <title>Mailbox</title>
</head>
<body>
<button>View mail</button>
<button>Send mail</button>
<form action="logout.php">
    <input type="submit" value="Disconnect"/>
</form>

</body>
</html>