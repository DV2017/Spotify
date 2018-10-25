<?php
//includes/handlers/ajax/updateEmail.php
include("../../config.php");

if(!isset($_POST['username'])){
    echo "Could not set username";
    exit();
}

if(isset($_POST['email']) && $_POST['email'] != "") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    //filter for correct email phrasing
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //if filter_validate_email returns false for the email
        echo "Invalid email";
        exit();
    }

    $emailCheck = mysqli_query($con, "SELECT email FROM users WHERE email='$email' AND username != '$username' ");
    if(mysqli_num_rows($emailCheck) > 0) {
        echo "This email already in use";
        exit();
    } 

    $updateQuery = mysqli_query($con, "UPDATE users SET email = '$email' WHERE username = '$username' ");
    echo "Email has been updated";

} else {
    echo "Please provide an email.";
}
?>