<?php
session_start(); // start the session
if (isset($_POST['save'])) { // check variable POST from FORM
    include "connection.php"; // call connection php mysql

    $query = "SELECT * FROM stock WHERE id_stock = '$_POST[id_phone]'"; // make a sql query 
    $sto = mysqli_query($db_connection, $query); // run query 

    if ($sto && mysqli_num_rows($sto) > 0) { // check if stock exists
        $stock_row = mysqli_fetch_assoc($sto);
        $available_stock = $stock_row['stok'];

        // Check if requested quantity is less than or equal to available stock
        if ($_POST['jumlah'] <= $available_stock) {
            // Check if total harga is less than or equal to tunai
            if ($_POST['tunai'] <= $_POST['total_harga']) {
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
                $update_stock = mysqli_query($db_connection, $upstok);

                if ($create && $update_stock) { // check if queries are successful            
                    echo "<script> alert('Transaction added successfully !'); </script>"; // success msg (javascript version)
                } else {
                    echo "<script> alert('Transaction added failed !'); </script>"; // fail msg (javascript)
                }
            } else {
                echo "<script> alert('Insufficient cash!'); </script>"; // fail msg for insufficient cash
            }
        } else {
            echo "<script> alert('Insufficient stock!'); </script>"; // fail msg for insufficient stock
        }
    } else {
        echo "<script> alert('Invalid stock ID!'); </script>"; // fail msg for invalid stock ID
    }
}
?>
<script>
    window.location.replace("read_transaksi.php");
</script>
