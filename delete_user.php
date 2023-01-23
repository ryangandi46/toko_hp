<?php
if(isset($_GET['id'])) { // check variable GET from URL
        include "connection.php"; //call connection php mysql

        // sql query DELETE SET WHERE
        $query = "DELETE FROM users WHERE userid = '$_GET[id]'";

        // run query
        $delete = mysqli_query($db_connection, $query);

        if($delete) { // check if query TRUE/success            
            //echo "<p>USer deleted successfully !</p>"; // success msg (html version)
            echo "<script> alert('user deleted successfully !'); </script>"; // success msg (javascript version)
        } else {
           // echo "<p>User deleted failed !</p>"; // fail msg (html)
            echo "<script> alert('user deleted failed !'); </script>"; // fail msg (javascript)
        }
    }
?>
<!-- <p><a href="read_pet.php">BACK TO LIST</a></p> -->
<script>window.location.replace("read_user.php");</script>