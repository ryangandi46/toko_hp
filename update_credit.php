<?php
if(isset($_POST['save'])) { // check variable POST from FORM
        include "connection.php"; //call connection php mysql

        // sql query UPDATE SET WHERE
        $query = "UPDATE credit SET                    
                    id_transaksi = '$_POST[id_transaksi]',                                                 
                    uang_muka = '$_POST[uang_muka]',                                                 
                    angsuran = '$_POST[angsuran]',                                                 
                    angsuran_berjalan = '$_POST[angsuran_berjalan]',                                                                                                                     
                    dana = '$_POST[dana]'                                                                                                                     
                    WHERE id_credit = '$_POST[id_credit]'";

        // run query
        $update = mysqli_query($db_connection, $query);

        if($update) { // check if query TRUE/success            
            //echo "<p>Credit updated successfully !</p>"; // success msg (html version)
            echo "<script> alert('Credit updated successfully !'); </script>"; // success msg (javascript version)
        } else {
           // echo "<p>Credit updated failed !</p>"; // fail msg (html)
            echo "<script> alert('Credit updated failed !'); </script>"; // fail msg (javascript)
        }
    }
?>
<script>window.location.replace("credit.php?id_transaksi=<?= $_POST['id_transaksi']; ?>");</script>