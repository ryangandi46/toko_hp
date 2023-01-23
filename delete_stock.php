<?php
if(isset($_GET['id'])) { // check variable GET from URL
        include "connection.php"; //call connection php mysql

        // sql query DELETE SET WHERE
        $query = "DELETE FROM stock WHERE id_stock = '$_GET[id]'";

        // run query
        $delete = mysqli_query($db_connection, $query);

        if($delete) { // check if query TRUE/success            
            //echo "<p>Stock deleted successfully !</p>"; // success msg (html version)
            echo "<script> alert('Stock deleted successfully !'); </script>"; // success msg (javascript version)
        } else {
           // echo "<p>Buyer deleted failed !</p>"; // fail msg (html)
            echo "<script> alert('Stock deleted failed !'); </script>"; // fail msg (javascript)
        }
    }
?>
<script>window.location.replace("read_Stock.php");</script>