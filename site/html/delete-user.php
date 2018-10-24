<?php
session_start();

if(!isset($_SESSION['user_id']) or $_SESSION['user_id'] != 0){
    header('Location: 404.php');
}

$id = $_GET['id'];
echo($id);
?>

