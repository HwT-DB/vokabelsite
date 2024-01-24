<?php
    include_once "./php/config.php";
    include_once "./php/translate.php";

    $queryString = $_SERVER['QUERY_STRING'];
    $parameters = explode(',', $queryString);

    $lang = $grade = $unit = null;

    foreach ($parameters as $parameter) {
        list($key, $value) = explode('=', $parameter);
    
        switch ($key) {
            case 'lang':
                $lang = $value;
                break;
            // case 'grade':
            //     $grade = $value;
            //     break;
            // case 'unit':
            //     $unit = $value;
            //     break;
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $translate["tasks_" . $lang]; ?></title>
    <meta charset="UTF-8">
    <meta name="description" content="Vokabel Quiz">
    <meta name="author" content="Domonkos 'der Rambo vom Balaton' Rémai-Sleisz & Sophia Pilz">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/learn.css">
</head>
<body>
    
</body>
</html>