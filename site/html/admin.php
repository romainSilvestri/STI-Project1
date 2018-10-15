<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 0){
    header('Location: logout.php');
}

echo "wesh wesh admin bro";

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
