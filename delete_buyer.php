<?php
if (isset($_GET['id'])) { // check variable GET from URL
    include "connection.php"; //call connection php mysql

    // sql query DELETE SET WHERE
    $query = "DELETE FROM buyer WHERE id_buyer = '$_GET[id]'";

    // run query
    $delete = mysqli_query($db_connection, $query);

    if ($delete) { // check if query TRUE/success            
        //echo "<p>Buyer deleted successfully !</p>"; // success msg (html version)
        echo "<script> alert('buyer deleted successfully !'); </script>"; // success msg (javascript version)
    } else {
        // echo "<p>Buyer deleted failed !</p>"; // fail msg (html)
        echo "<script> alert('buyer deleted failed !'); </script>"; // fail msg (javascript)
    }
}
?>
<script>
    window.location.replace("read_buyer.php");
</script>