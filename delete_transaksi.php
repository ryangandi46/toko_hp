<?php
if(isset($_GET['id'])) { // check variable GET from URL
        include "connection.php"; //call connection php mysql

        // sql query DELETE SET WHERE
        $query = "DELETE FROM transaksi WHERE id_transaksi = '$_GET[id]'";

        // run query
        $delete = mysqli_query($db_connection, $query);

        if($delete) { // check if query TRUE/success            
            //echo "<p>Transaction deleted successfully !</p>"; // success msg (html version)
            echo "<script> alert('Transaction deleted successfully !'); </script>"; // success msg (javascript version)
        } else {
           // echo "<p>Transaction deleted failed !</p>"; // fail msg (html)
            echo "<script> alert('Transaction deleted failed !'); </script>"; // fail msg (javascript)
        }
    }
?>
<script>window.location.replace("read_transaksi.php");</script>