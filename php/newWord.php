<?php
    include_once "config.php";
    include_once "translate.php";
    $lang = mysqli_real_escape_string($conn, $_POST['lang']);
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $unit = mysqli_real_escape_string($conn, $_POST['unit']);

    if(!empty($lang) && !empty($grade) && !empty($unit)) {
        $sql = mysqli_query($conn, "SELECT * FROM words_{$lang} WHERE grade = {$grade} AND unit = {$unit}");
        if(mysqli_num_rows($sql) > 0) {
            $list = [];
            $rand1 = mt_rand(1, 2);
            while ($row = mysqli_fetch_assoc($sql)) {
                $list[] = $row['lang'.$rand1];
            }
            $count = count($list) - 1;
            $rand2 = mt_rand(0, $count);
            echo '{"type": "'. $rand1 .'", "word": "'. $list[$rand2] .'"}';
        } else {
            echo "err";
        }
    } else {
        echo "err";
    }
?>