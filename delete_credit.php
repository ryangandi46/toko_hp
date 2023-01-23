<?php
if (isset($_GET['id'])) { // check variable GET from URL
    include "connection.php"; //call connection php mysql

    // sql query DELETE SET WHERE
    $query = "DELETE FROM credit WHERE id_transaksi = '$_GET[id_credit]'";

    // run query
    $delete = mysqli_query($db_connection, $query);

    if ($delete) { // check if query TRUE/success            
        //echo "<p>Credit deleted successfully !</p>"; // success msg (html version)
        echo "<script> alert('Credit deleted successfully !'); </script>"; // success msg (javascript version)
    } else {
        // echo "<p>Credit deleted failed !</p>"; // fail msg (html)
        echo "<script> alert('Credit deleted failed !'); </script>"; // fail msg (javascript)
    }
}
?>
<script>
    window.location.replace("credit.php?id_transaksi=<?= $_POST['id_transaksi']; ?>");
</script>