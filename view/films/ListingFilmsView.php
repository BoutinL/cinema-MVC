<?php ob_start();?>

<p>Il y a <?= $requete->rowCount() ?> films</p> 
<a href='index.php?action=afficherRealisateurs'>Ajouter un film</a>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Année de sortie</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><a href='index.php?action=detailFilm&id=<?= $film["id_film"] ?>'><?= $film["titre"] ?></td>
                    <td><?= $film["dateSortie"]?></td>
                    <td><a href='index.php?action=effacerFilm&id=<?= $film["id_film"] ?>'>Effacer</a></td>
                </tr>
        <?php } ?>
    </tbdoy>
</table>

<?php

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";