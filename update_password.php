<?php
    session_start(); // start the session
    if(isset($_POST['change'])) { // check variable POST from FORM
        include "connection.php"; // call connection

        // encrypt the new password
        $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
 
        // make query for update password
        $query="UPDATE users SET password='$password' WHERE userid='$_SESSION[userid]'";

        // run the query
        $update=mysqli_query($db_connection, $query);

        if($update) { // check query result TRUE/success 
            $_SESSION['password']=$password; // update data session if success
            // success msg
            echo "<script>alert('Change password successed !');window.location.replace('index.php');</script>";
        } else {
            // failed msg
            echo "<script>alert('Change password failed !');window.location.replace('change_password.php');</script>";
        }
    }
?>