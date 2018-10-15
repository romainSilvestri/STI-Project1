<?php
session_start();
if(!empty($_POST)){
    echo "";
    if(isset($_POST['username']) && isset($_POST['password'])){
        echo "not null";
        if(true){
            $_SESSION['user_id'] = 1;
            header('Location: view.php');
        }else{
            header('Location: index.php');
        }

        if($_POST['username'] == "admin"){
            //TODO: verify mdp
            $_SESSION['user_id'] = 0;
            header('Location: admin.php');
        }

        /**  https://www.johnmorrisonline.com/build-php-login-form-using-sessions/
         * // Verify user password and set $_SESSION
        if ( password_verify( $_POST['password'], $user->password ) ) {
        $_SESSION['user_id'] = $user->ID;
        }
         */
    }
}
?>


