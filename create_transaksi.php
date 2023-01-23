<?php
session_start(); // start the session
if (isset($_POST['save'])) { // check variable POST from FORM
    include "connection.php"; //call connection php mysql

    $query = "SELECT * FROM stock WHERE id_stock = '$_GET[id_stock]'"; // make a sql query 
    $sto = mysqli_query($db_connection, $query); // run query 

    // sql query INSERT INTO SET
    $query = "INSERT INTO transaksi SET
                    id_buyer   = '$_POST[buyer]',                                      
                    id_stock   = '$_POST[id_phone]',                                      
                    userid    = '$_POST[user]',
                    phone       = '$_POST[phone]',                   
                    jumlah     = '$_POST[jumlah]',                                       
                    total_harga      = '$_POST[total_harga]',   
                    tunai      = '$_POST[tunai]',                  
                    type_pembayaran = '$_POST[type_pembayaran]',
                    status = '$_POST[status]'";
    // run query
    $create = mysqli_query($db_connection, $query);

    // update jumlah stock
    $upstok = "UPDATE stock SET stok=stok-$_POST[jumlah] WHERE id_stock = '$_POST[id_phone]'";
    $create = mysqli_query($db_connection, $upstok);

    if ($create) { // check if query TRUE/success            
        //echo "<p>Transaction added successfully !</p>"; // success msg (html version)
        echo "<script> alert('Transaction added successfully !'); </script>"; // success msg (javascript version)
    } else {
        // echo "<p>Transaction add failed !</p>"; // fail msg (html)
        echo "<script> alert('Transaction added failed !'); </script>"; // fail msg (javascript)
    }
}
?>
<script>
    window.location.replace("read_transaksi.php");
</script>
?>