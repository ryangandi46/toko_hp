<?php
if(isset($_POST['save'])) { // check variable POST from FORM
        include "connection.php"; //call connection php mysql

        // sql query UPDATE SET WHERE
        $query = "UPDATE buyer SET                    
                    name_buyer = '$_POST[name_buyer]',
                    address_buyer = '$_POST[address_buyer]',
                    noktp = '$_POST[noktp]',
                    npwp = '$_POST[npwp]',
                    nohp_buyer = '$_POST[phone_buyer]'
                    WHERE id_buyer = '$_POST[id_buyer]'
                    ";

        // run query
        $update = mysqli_query($db_connection, $query);

        if($update) { // check if query TRUE/success            
            //echo "<p>Buyer updated successfully !</p>"; // success msg (html version)
            echo "<script> alert('Buyer updated successfully !'); </script>"; // success msg (javascript version)
        } else {
           // echo "<p>Buyer updated failed !</p>"; // fail msg (html)
            echo "<script> alert('Buyer updated failed !'); </script>"; // fail msg (javascript)
        }
    }
?>
<script>window.location.replace("read_buyer.php");</script>