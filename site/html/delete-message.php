<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header('Location: 404.php');
}

$id = $_GET['id'];
echo($id);
?>

