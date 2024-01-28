<?php
    include_once "config.php";
    include_once "translate.php";
    $lang = mysqli_real_escape_string($conn, $_POST['lang']);

    if(!empty($lang)) {
        $sql = mysqli_query($conn, "SELECT grade FROM max_unit WHERE lang = '{$lang}' ORDER BY grade ASC;");
        if(mysqli_num_rows($sql) > 0) {
            $output = '<option value="def" selected hidden>Choose a grade...</option>';
            $grade = $translate["grade_" . $lang];
            while ($row = mysqli_fetch_assoc($sql)) {
                $output .= '<option value="'. $row['grade'] .'">'. $grade . $row['grade'] .'</option>';
            }
            echo $output;
        } else {
            echo "err";
        }
    } else {
        echo "err";
    }
?>