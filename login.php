<?php
    session_start(); // start the session
    if(isset($_POST['login'])) { // check post variable from FORM
        include "connection.php"; // call connection

        //make the query based on username
        $query="SELECT * FROM users WHERE username='$_POST[username]'";

        //run the query
        $login=mysqli_query($db_connection,$query);

        if(mysqli_num_rows($login) > 0) { // check if the username found or not
            $user=mysqli_fetch_assoc($login); // if user found, extract the data
            if(password_verify($_POST['password'], $user['password'])) { // verify the password

                // variale session untuk menyimpan data sementara di server
                // if password match, then make session variable
                $_SESSION['login']=TRUE;
                $_SESSION['userid']=$user['id'];
                $_SESSION['username']=$user['username'];
                $_SESSION['password']=$user['password'];
                $_SESSION['usertype']=$user['usertype'];
                $_SESSION['fullname']=$user['fullname'];

                //success login msg
                echo "<script>alert('Login success !');window.location.replace('index.php');</script>";
            } else { // password did not match
                //wrong password msg then redirect to login form
                echo "<script>alert('Login failed, wrong password !');window.location.replace('form_login.php');</script>";            
            }
        } else { //user not found
            // login failed msg then redirect to login form
            echo "<script>alert('Login failed, user not found !');window.location.replace('form_login.php');</script>";
        }
    }
?>