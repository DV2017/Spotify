<?php
//includes/handlers/login-handler.php

if(isset($_POST['loginButton'])){
    //login button in register.php was pressed
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    //login function
    $result = $account->login($username, $password);

    if($result == true) {
        $_SESSION['userLoggedIn'] = $username;
        header("Location: index.php");
    }
}
?>