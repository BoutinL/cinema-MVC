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
            <nav class="navbar">
                <ul>
                    <a href='index.php?action=listFilms'>Films</a>
                    <a href='index.php?action=listActeurs'>Acteurs</a>
                    <a href='index.php?action=listRealisateurs'>Réalisateurs</a>
                </ul>
            </nav>
            <div id="contenu">
                <h1>PDO Cinema</h1>
                <h2><?= $titre_secondaire ?></h2>
                <?= $contenu ?>
            </div>
        </main>
    </body>
</html>