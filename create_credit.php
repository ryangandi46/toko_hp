<?php
if (isset($_POST['save'])) { // check variable POST from FORM
    include "connection.php"; //call connection php mysql

    // Periksa semua pembayaran yang belum lunas
    $query = "SELECT * FROM credit WHERE id_transaksi";
    $result = mysqli_query($db_connection, $query);
    

    // sql query INSERT INTO VALUES
    $query = "INSERT INTO credit (id_transaksi, uang_muka, angsuran, angsuran_berjalan, dana) VALUES ('$_POST[id_transaksi]', '$_POST[uang_muka]', '$_POST[angsuran]', '$_POST[angsuran_berjalan]', '$_POST[dana]')";

    // run query
    $create = mysqli_query($db_connection, $query);

    //check if payment equals total price
    if ($_POST['angsuran_berjalan'] == $_POST['angsuran']) {
        //update order status to "paid"
        $query_update = "UPDATE transaksi SET status = 'Lunas'  WHERE id_transaksi = '$_POST[id_transaksi]'";
        $res = mysqli_query($db_connection, $query_update);
        if ($query_update) {
            echo "<script> alert('Credit anda telah selesai (LUNAS)!'); </script>";       
    } else {
        echo "<script> alert('Credit anda belum selesai (BELUM LUNAS)!'); </script>";
    }
    }
    if ($create) { // check if query TRUE/success            
        //echo "<p>Credit added successfully !</p>"; // success msg (html version)
        echo "<script> alert('Credit added successfully !'); </script>"; // success msg (javascript version)
    } else {
        // echo "<p>Credit add failed !</p>"; // fail msg (html)
        echo "<script> alert('Credit added failed !'); </script>"; // fail msg (javascript)
    }
}
?>
<script>
    window.location.replace("credit.php?id_transaksi=<?= $_POST['id_transaksi']; ?>");
</script>

