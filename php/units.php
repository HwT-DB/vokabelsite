<?php
    include_once "config.php";
    include_once "translate.php";
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $lang = mysqli_real_escape_string($conn, $_POST['lang']);

    if(!empty($grade) && !empty($lang)) {
        $sql = mysqli_query($conn, "SELECT max_unit FROM max_unit WHERE grade = {$grade} AND lang = '{$lang}'");
        if(mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            $max_unit = $row['max_unit'];
            $output = '<option value="def" selected hidden>Choose a unit...</option>';
            $unit = $translate["unit_" . $lang];
            for ($i=1; $i <= $max_unit; $i++) { 
                $output .= '<option value="'. $i .'">'. $unit . $i .'</option>';
            }
            echo $output;
        } else {
            echo "err";
        }
    } else {
        echo "err";
    }
?>