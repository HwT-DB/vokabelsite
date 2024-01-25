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
    <a href="./index.html" class="back">&lt; Zurück</a>
    <div class="box">
        <p><b>HELFEN:</b><br>Übersetzen Sie die Wörter ins Deutsche bzw. aus dem Deutschen in die Sprache Ihrer Wahl<hr></p>
        <p><b>Sprache: <?php echo $translate['lang_' . $lang] ?></b></p>
        <input type="text" value="Szóóó" disabled>
        <hr>
        <input type="text" id="translate" placeholder="<?php echo $translate['translate_' . $lang]; ?>...">
        <br>
        <button onclick="Check(document.getElementById('translate').value)">Check</button>
    </div>
</body>
    <script src="./js/learn.js"></script>
</html>