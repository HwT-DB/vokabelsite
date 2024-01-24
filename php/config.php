<?php
    $conn = mysqli_connect("localhost", "kriptonadmin", "ldawy_8d26W_A687DA", "vocab");
    if(!$conn) {
        echo "Database not connected" . mysqli_connect_error();
    }
?>