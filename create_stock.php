<?php  
    if(isset($_POST['save'])) { // check variable POST from FORM
        include "connection.php"; //call connection php mysql

        // sql query INSERT INTO VALUES
        $query = "INSERT INTO stock (phone, price, stok, spek) VALUES ('$_POST[phone]', 
        '$_POST[price_phone]', '$_POST[stock_phone]', '$_POST[spek_phone]')";

        // run query
        $create = mysqli_query($db_connection, $query);

        if($create) { // check if query TRUE/success            
            //echo "<p>doctor added successfully !</p>"; // success msg (html version)
            echo "<script> alert('stock added successfully !'); </script>"; // success msg (javascript version)
        } else {
           // echo "<p>doctor add failed !</p>"; // fail msg (html)
            echo "<script> alert('stock added failed !'); </script>"; // fail msg (javascript)
        }
    }
?>
<!-- <p><a href="read_pet.php">BACK TO LIST</a></p> -->
<script>window.location.replace("read_stock.php");</script>
?>