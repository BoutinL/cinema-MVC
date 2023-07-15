<?php 
    ob_start(); 
    // fetch
    $film = $requete->fetch();
    $genre = $requeteGenre->fetchAll();
    $realisateur = $requeteRealisateur->fetch();

    // string qui rassemble les genres d'un même film
    $types="";
    foreach( $genre as $type ){
        $types .= $type["nom"]. " ";
    }

    // conversion au format d-m-Y
    $dateSortieAncienFormat = $film['dateSortie'];
    $dateSortieNouveauFormat = date('d-m-Y', strtotime($dateSortieAncienFormat));

    // conversion minutes au format h:m
    $minutes = $film['dureeMinutes'];
    $heures = floor($minutes / 60); // Obtient le nombre d'heures entières
    $minutesRestantes = $minutes % 60; // Obtient le nombre de minutes restantes
    $heureMinute = sprintf("%02d:%02d", $heures, $minutesRestantes);
?>

<section class="detail-film">
<a href='index.php?action=modifierFilm'>Modifier ce film</a>
<h3>Nom du film : <?= $film['titre'] ?></h3>
<img src="<?= $film['affiche'] ?>" alt="">
<p>Genre(s) : <?= $types ?></p>
<p>Réalisateur : <?= $realisateur['prenom']." ".$realisateur['nom'] ?></p>
<p>Date de sortie : <?= $dateSortieNouveauFormat ?></p>
<p>Durée : <?= $heureMinute ?></p>
<p>Note : <?= $film['note'] ?></p>
</section>
<section class="casting">
    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Rôle</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($requeteCasting->fetchAll() as $acteur) { ?>
                    <tr>
                        <td><a href='index.php?action=detailActeur&id=<?= $acteur["id_personne"] ?>'><?= $acteur[ "prenom" ] ?></a></td>
                        <td><a href='index.php?action=detailActeur&id=<?= $acteur["id_personne"] ?>'><?= $acteur[ "nomActeur" ] ?></a></td>
                        <td><?= $acteur[ "nomRole" ] ?></td>
                    </tr>
            <?php } ?>
        </tbdoy>
    </table>
</section>
<?php

$titre = $film[ 'titre' ];
$titre_secondaire = " Détails du film ". $film[ 'titre' ];
$contenu = ob_get_clean();
require "view/template.php";