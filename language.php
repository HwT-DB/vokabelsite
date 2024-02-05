<?php
    include_once "./php/config.php";
    include_once "./php/translate.php";
    $lang = mysqli_real_escape_string($conn, $_GET['lang']);
    if(empty($lang)) {
        header("location: ./index.html");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="./css/langs.css">
        <title>
            Vokabeln - <?php echo $translate['lang_' . $lang]; ?>
        </title>
        <meta charset="UTF-8">
        <meta name="description" content="Vokabel Quiz">
        <meta name="author" content="Domonkos 'der Rambo vom Balaton' Rémai-Sleisz & Sophia Pilz">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <a href="./home.html" class="back">&lt; Zurück</a>
        <div class="box">
            <h1>Choose a grade and a unit!</h1>
            <hr>
            <div class="inputs">
                <select id="grade" disabled>
                    <option value="def" selected hidden>Choose a grade...</option>
                </select>
                <select id="unit" disabled>
                    <option value="def" selected hidden>Choose a unit...</option>
                </select>
            </div>
            <button onclick="Run(parseInt(document.getElementById('grade').value), document.getElementById('unit').value)">Start learning!</button>
        </div>
    </body>
    <script>
        let l = "<?php echo $lang; ?>";
    </script>
    <script src="./js/language.js"></script>
</html>