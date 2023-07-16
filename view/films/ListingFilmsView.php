<?php ob_start();
$film = $requete->fetch();
$annee = date("Y", strtotime($film["dateSortie"]));
?>

<p>Il y a <?= $requete->rowCount() ?> films</p> 
<a href='index.php?action=ajouterFilm'>Ajouter un film</a>

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
                    <td><?= $annee ?></td>
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