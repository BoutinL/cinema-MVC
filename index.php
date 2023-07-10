<?php

use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
    include $class_name .'php';
});

$ctrlCinema = new CinemaController();

if(isset($_GET["action"])){
    switch ($_GET["action"]) {
        case "listFilms" : $ctrlCinema->listFilms(); breaks;
        case "listActeurs" : $ctrlCinema->listActeurs(); breaks;
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/style.css">
        <title><?= $titre ?></title>
    </head>
    <body>
        <main>
            <div id="contenu">
                <h1 class ="">PDO Cinema</h1>
                <h2 class=""><?= $titre_secondaire ?></h2>
                <?= $contenu ?>
            </div>
        </main>
    </body>
</html>