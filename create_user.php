<?php 
    if(isset($_POST['save'])) { // check variable POST from FORM
        include "connection.php"; //call connection php mysql

        //create default password
        $password = password_hash($_POST['usertype'], PASSWORD_DEFAULT);

        // sql query INSERT INTO VALUES
        $query = "INSERT INTO users (username, password,usertype, fullname) VALUES ('$_POST[username]', 
        '$password', '$_POST[usertype]', '$_POST[fullname]')";

        // run query
        $create = mysqli_query($db_connection, $query);

        if($create) { // check if query TRUE/success            
            //echo "<p>user added successfully !</p>"; // success msg (html version)
            echo "<script> alert('user added successfully !'); </script>"; // success msg (javascript version)
        } else {
           // echo "<p>user add failed !</p>"; // fail msg (html)
            echo "<script> alert('user added failed !'); </script>"; // fail msg (javascript)
        }
    }
?>
<!-- <p><a href="read_pet.php">BACK TO LIST</a></p> -->
<script>window.location.replace("read_user.php");</script>
