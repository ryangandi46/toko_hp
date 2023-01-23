<?php
if(isset($_POST['save'])) { // check variable POST from FORM
        include "connection.php"; //call connection php mysql

        // sql query UPDATE SET WHERE
        $query = "UPDATE stock SET                    
                    phone = '$_POST[phone]',                    
                    price = '$_POST[price_phone]',
                    stok = '$_POST[stock_phone]',
                    spek = '$_POST[spek_phone]'            
                    WHERE id_stock = '$_POST[id_stock]'
                    ";

        // run query
        $update = mysqli_query($db_connection, $query);

        if($update) { // check if query TRUE/success            
            //echo "<p>Stock updated successfully !</p>"; // success msg (html version)
            echo "<script> alert('Stock updated successfully !'); </script>"; // success msg (javascript version)
        } else {
           // echo "<p>Stock updated failed !</p>"; // fail msg (html)
            echo "<script> alert('Stock updated failed !'); </script>"; // fail msg (javascript)
        }
    }
?>
<script>window.location.replace("read_stock.php");</script>