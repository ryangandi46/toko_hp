<?php  
    if(isset($_POST['save'])) { // check variable POST from FORM
        include "connection.php"; //call connection php mysql

        // sql query INSERT INTO VALUES
        $query = "INSERT INTO buyer (name_buyer, address_buyer, noktp, npwp, nohp_buyer) VALUES ('$_POST[name_buyer]', 
        '$_POST[address_buyer]', '$_POST[noktp]', '$_POST[npwp]', '$_POST[phone_buyer]')";

        // run query
        $create = mysqli_query($db_connection, $query);

        if($create) { // check if query TRUE/success            
            //echo "<p>doctor added successfully !</p>"; // success msg (html version)
            echo "<script> alert('buyer added successfully !'); </script>"; // success msg (javascript version)
        } else {
           // echo "<p>doctor add failed !</p>"; // fail msg (html)
            echo "<script> alert('buyer added failed !'); </script>"; // fail msg (javascript)
        }
    }
?>
<!-- <p><a href="read_pet.php">BACK TO LIST</a></p> -->
<script>window.location.replace("read_buyer.php");</script>
?>