<?php
    include_once "config.php";
    include_once "translate.php";
    $lang = mysqli_real_escape_string($conn, $_POST['lang']);
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $unit = mysqli_real_escape_string($conn, $_POST['unit']);
    $ans = mysqli_real_escape_string($conn, $_POST['ans']);
    $def_word = mysqli_real_escape_string($conn, $_POST['def_word']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $type2 = $type == 1 ? $type2 = 2 : $type2 = 1;

    if(!empty($lang) && !empty($grade) && !empty($unit) && !empty($ans) && !empty($def_word) && !empty($type)) {
        $sql = mysqli_query($conn, "SELECT lang{$type2} FROM words_{$lang} WHERE grade = {$grade} AND unit = {$unit} AND lang{$type} = '{$def_word}'");
        if(mysqli_num_rows($sql) == 1) {
            $row = mysqli_fetch_assoc($sql);
            $w = $row['lang' . $type2];
            if(strcmp($w, $ans) === 0) {
                echo '{"stat": "success"}';
            } else {
                echo '{"stat": "fail", "good": "'. $w .'"}';
            }
        } elseif (mysqli_num_rows($sql) > 1) {
            $success = false;
            $good = "";
            $i = 0;
            while ($row = mysqli_fetch_assoc($sql)) {
                $i++;
                $w = $row['lang' . $type2];
                if(strcmp($w, $ans) === 0) {
                    $success = true;
                } else {
                    $good .= $w;
                }
                if($i != mysqli_num_rows($sql)) $good .= ' / ';
            }
            if($success) {
                echo '{"stat": "success"}';
            } else {
                echo '{"stat": "fail", "good": "'. $good .'"}';
            }
        } else {
            echo "err";
        }
    } else {
        echo "err";
    }
?>