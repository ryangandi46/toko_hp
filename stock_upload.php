<?php
    if(isset($_POST['upload'])) { // check variable POST from FORM
        include "connection.php"; // call connection
        
        $folder = 'uploads/stock/'; // target folder for upload
        if(move_uploaded_file($_FILES['new_photo']['tmp_name'], $folder . $_FILES['new_photo']['name'])) {

            // success upload, get the photo name
            $photo=$_FILES['new_photo']['name'];

            // make query for update photo
            $query="UPDATE stock SET photo_stock='$photo' WHERE id_stock='$_POST[id_stock]'";

            // run the query
            $upload=mysqli_query($db_connection, $query);

            if($upload) { // check query result TRUE/success 
                if($_POST['photo_stock'] !== 'default.png') unlink($folder . $_POST['photo_stock']); // delete old photo
                // success msg
                echo "<script>alert('Change photo success !');window.location.replace('read_stock.php');</script>";                
            } else {
                // failed msg
                echo "<script>alert('Change photo failed !');window.location.replace('stock_photo.php?id_stock=$_POST[id_stock]');</script>";
            }
            // failed upload
        } else {
            echo "<script>alert('Upload photo failed !');window.location.replace('stock_photo.php?id_stock=$_POST[id_stock]');</script>";
        }
    }
?>