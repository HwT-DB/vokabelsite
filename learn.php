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
            case 'grade':
                $grade = $value;
                break;
            case 'unit':
                $unit = $value;
                break;
        }
    }
    if(empty($lang) || empty($grade) || empty($unit)) {
        header("location: ./index.html");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Aufgaben - <?php echo $translate['lang_' . $lang]; ?></title>
    <meta charset="UTF-8">
    <meta name="description" content="Vokabel Quiz">
    <meta name="author" content="Domonkos 'der Rambo vom Balaton' Rémai-Sleisz & Sophia Pilz">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/learn.css">
</head>
<body>
    <a href="./home.html" class="back">&lt; Zurück</a>
    <div class="box">
        <p><b>HILFE:</b><br>Übersetzen Sie die Wörter ins Deutsche bzw. aus dem Deutschen in die Sprache Ihrer Wahl!<hr></p>
        <p><b>Sprache: <?php echo $translate['lang_' . $lang] ?></b></p>
        <input type="text" id="word" value="Szóóó" disabled>
        <hr>
        <input type="text" id="translate" placeholder="Übersetzung...">
        <br>
        <h3 id="errors">1/2</h3>
        <button id="check" onclick="Check(document.getElementById('translate').value)">Abgabe</button>
        <button id="continue" class="hide" onclick="Continue()">&gt; Weiter &gt;</button>
    </div>
    <h5 id="streak_c"></h5>
    <button id="showCharacters">Sonderzeichen</button>
    <ul id="specialCharacters">
    <li>¿</li>
    <li>¡</li>
    <li>ñ</li>
    <!-- Ide írhatod a további speciális karaktereket -->
    </ul>
</body>
    <script>
        let l = "<?php echo $lang; ?>";
        let g = <?php echo $grade; ?>;
        let u = <?php echo $unit; ?>;
    </script>
    <script src="./js/learn.js"></script>
</html>