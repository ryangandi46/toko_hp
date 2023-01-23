<?php
if(isset($_POST['save'])) { // check variable POST from FORM
        include "connection.php"; //call connection php mysql

        // sql query UPDATE SET WHERE
        $query = "UPDATE users SET 
                    username = '$_POST[username]',                 
                    usertype = '$_POST[usertype]',
                    fullname = '$_POST[fullname]'
                    WHERE userid = '$_POST[userid]'
                    ";

        // run query
        $update = mysqli_query($db_connection, $query);

        if($update) { // check if query TRUE/success            
            //echo "<p>User updated successfully !</p>"; // success msg (html version)
            echo "<script> alert('user updated successfully !'); </script>"; // success msg (javascript version)
        } else {
           // echo "<p>User updated failed !</p>"; // fail msg (html)
            echo "<script> alert('user updated failed !'); </script>"; // fail msg (javascript)
        }
    }
?>
<!-- <p><a href="read_pet.php">BACK TO LIST</a></p> -->
<script>window.location.replace("read_user.php");</script>