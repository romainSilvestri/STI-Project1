<?php

include 'database/database.php';

session_start();
if(!empty($_POST)){
    if(isset($_POST['username']) && isset($_POST['password'])){
        if(isUserValid($_POST['username'], $_POST['password'])){
            if(isAdmin($_POST['username'])){
                $_SESSION['user_id'] = 0;
                header('Location: admin.php');
            }
            $_SESSION['user_id'] = 1;
            header('Location: view.php');
        }
    }
    
    header('Location: index.php');
}
?>


